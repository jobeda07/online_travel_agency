<?php

namespace App\Infra\Repositories;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Point;
use App\Models\HotelBooking;
use App\Models\AccountLedger;

class HotelBookingRepository
{
    private HotelBooking $hotelBooking;
    private Point $point;
    public function __construct(HotelBooking $hotelBooking, Point $point)
    {
        $this->hotelBooking = $hotelBooking;
        $this->point = $point;
    }

    public function allHotelBookingGet()
    {
        $hotelBooks = $this->hotelBooking->get();
        return $hotelBooks;
    }
    public function storeHotelBooking(array $data)
    {
        $pointDiscount = $this->calculatePointDiscount($data['point_discount'] ?? 0);

        $hotelBooking = new HotelBooking();
        $hotelBooking->customer_id = $data['customer_id'];
        $hotelBooking->booking_code = $data['booking_code'];
        $hotelBooking->hotel_code = $data['hotel_code'];
        $hotelBooking->checkin_date = $data['checkin_date'];
        $hotelBooking->checkout_date = $data['checkout_date'];
        $hotelBooking->room_no = $data['room_no'];
        $hotelBooking->room_type = $data['room_type'];
        $hotelBooking->country_id = $data['country_id'];
        $hotelBooking->city_id = $data['city_id'];
        $hotelBooking->no_of_adult = $data['no_of_adult'];
        $hotelBooking->no_of_child = $data['no_of_child'];
        $hotelBooking->adult_base_price = $data['adult_base_price'];
        $hotelBooking->child_base_price = $data['child_base_price'];

        $hotelBooking->total_price = ($data['adult_base_price'] * $data['no_of_adult']) + ($data['child_base_price'] * $data['no_of_child']);

        $hotelBooking->discount_amount = $data['discount_amount'];
        $hotelBooking->point_discount = $pointDiscount;
        $hotelBooking->vat = $data['vat'];
        $hotelBooking->extra_charge = $data['extra_charge'];
        $hotelBooking->extra_charge_details = $data['extra_charge_details'];

        $hotelBooking->grand_total = round($hotelBooking->total_price + $data['vat'] + $data['extra_charge'] - $data['discount_amount'] - $pointDiscount);

        $hotelBooking->paid_amount = $data['paid_amount'];
        $hotelBooking->status = 1;
        $hotelBooking->payment_status = 0;
        $hotelBooking->payment_method = $data['payment_method'];
        $hotelBooking->payment_details = $data['payment_details'];
        $hotelBooking->save();

        if ($hotelBooking->point_discount > 0) {
            $this->deductCustomerPoints($hotelBooking->id, $data['point_discount'] ?? 0);
        }

        $this->rewardCustomerPoints($hotelBooking->id);

        if( $hotelBooking->paid_amount >0){
            $this->accountLedger($hotelBooking->id);
        }
        return $hotelBooking;
    }
    private function calculatePointDiscount($pointDiscount)
    {
        if (empty($pointDiscount)) {
            return 0;
        }
        $settingPointDiscount = get_setting('point_amount_discount')->value ?? 1;
        $settingPurchasePoint = get_setting('purchase_amount_point')->value ?? 100;
        if ($pointDiscount >= $settingPurchasePoint) {
            $takeCount = floor($pointDiscount / $settingPurchasePoint);
            return $settingPointDiscount * $takeCount;
        }
        return 0;
    }
    private function deductCustomerPoints($id, $data)
    {
        $hotelBooking = $this->hotelBooking->findOrFail($id);
        $remainingAmountToDeduct = $data;
        $customerPoints = $this->point->where('customer_id', $hotelBooking->customer_id)
            ->where('validity', '>=', now())
            ->orderBy('created_at', 'asc')
            ->get();
        foreach ($customerPoints as $point) {
            if ($remainingAmountToDeduct <= 0) {
                break;
            }
            if ($point->used_amount >= $remainingAmountToDeduct) {
                $point->used_amount -= $remainingAmountToDeduct;
                $remainingAmountToDeduct = 0;
            } else {
                $remainingAmountToDeduct -= $point->used_amount;
                $point->used_amount = 0;
            }
            $point->save();
            if ($point->used_amount <= 0) {
                $point->delete();
            }
        }
    }
    private function rewardCustomerPoints($id)
    {
        $hotelBooking = $this->hotelBooking->findOrFail($id);
        $settingPurAmount = get_setting('purchase_amount')->value ?? 1000;
        $settingPoint = get_setting('purchase_amount_point')->value ?? 100;
        if ($hotelBooking->grand_total >= $settingPurAmount) {
            $takeCount = floor($hotelBooking->grand_total / $settingPurAmount);
            Point::create([
                'customer_id' => $hotelBooking->customer_id,
                'booking_id' => $hotelBooking->id,
                'booking_type' => 2,
                'amount' => $settingPoint * $takeCount,
                'used_amount' => $settingPoint * $takeCount,
                'validity' => now()->addDays(45),
            ]);
        }
    }
    private function accountLedger($id)
{
    $hotelBooking = $this->hotelBooking->findOrFail($id);
    $amount = get_account_balance();
    $oldAccountLedger = AccountLedger::where('ticket_id', $hotelBooking->id)
                        ->where('ticket_type', 2)
                        ->first();

    if ($oldAccountLedger) {
        $creditDifference = $hotelBooking->paid_amount - $oldAccountLedger->credit;
        $oldAccountLedger->balance += $creditDifference;

        $oldAccountLedger->particulars = 'Hotel Booking Code: ' . $hotelBooking->booking_code;
        $oldAccountLedger->credit = $hotelBooking->paid_amount;
        $oldAccountLedger->save();
    } else {
        $ledger = AccountLedger::create([
            'account_head_id' => 1,
            'particulars' => 'Hotel Booking Code: ' . $hotelBooking->booking_code,
            'credit' => $hotelBooking->paid_amount,
            'ticket_id' => $hotelBooking->id,
            'ticket_type' => 2,
            'account_type' => 2,
        ]);
        $ledger->balance = $amount + $hotelBooking->paid_amount;
        $ledger->save();
    }
}
    public function findHotelBookingById($id)
    {
        return $this->hotelBooking->findOrFail($id);
    }

    public function updateHotelBooking($id, array $data)
    {
        $hotelBooking = $this->findHotelBookingById($id);
        $hotelBooking->customer_id = $data['customer_id'];
        $hotelBooking->booking_code = $data['booking_code'];
        $hotelBooking->hotel_code = $data['hotel_code'];
        $hotelBooking->checkin_date = $data['checkin_date'];
        $hotelBooking->checkout_date = $data['checkout_date'];
        $hotelBooking->room_no = $data['room_no'];
        $hotelBooking->room_type = $data['room_type'];
        $hotelBooking->country_id = $data['country_id'];
        $hotelBooking->city_id = $data['city_id'];
        $hotelBooking->no_of_adult = $data['no_of_adult'];
        $hotelBooking->no_of_child = $data['no_of_child'];
        $hotelBooking->adult_base_price = $data['adult_base_price'];
        $hotelBooking->child_base_price = $data['child_base_price'];

        $hotelBooking->total_price = ($data['adult_base_price'] * $data['no_of_adult']) + ($data['child_base_price'] * $data['no_of_child']);

        $hotelBooking->discount_amount = $data['discount_amount'];
        $hotelBooking->vat = $data['vat'];
        $hotelBooking->extra_charge = $data['extra_charge'];
        $hotelBooking->extra_charge_details = $data['extra_charge_details'];

        $hotelBooking->grand_total = $hotelBooking->total_price + $data['vat'] + $data['extra_charge'] - $data['discount_amount'] - $hotelBooking->point_discount;

        $hotelBooking->paid_amount = $data['paid_amount'];
        $hotelBooking->status = $hotelBooking->status;
        $hotelBooking->payment_status = $hotelBooking->payment_status;
        $hotelBooking->payment_method = $data['payment_method'];
        $hotelBooking->payment_details = $data['payment_details'];
        $hotelBooking->save();
        if( $hotelBooking->paid_amount >0){
            $this->accountLedger($hotelBooking->id);
        }
        return $hotelBooking;
    }
    public function deleteHotelBooking($id)
    {
        $hotelBooking = $this->hotelBooking->find($id);
        if ($hotelBooking) {
            return $hotelBooking->delete();
        }
    }
    public function statusHotelBooking($id)
    {
        $hotelBooking = $this->hotelBooking->find($id);
        $hotelBooking->status = $hotelBooking->status == 1 ? 0 : 1;
        $hotelBooking->save();
        return $hotelBooking;
    }
    public function pdfHotelBookingById($id)
    {
        $hotelBooking = $this->hotelBooking->find($id);
        if (!$hotelBooking) {
            abort(404, 'Booking not found.');
        }
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('chroot', realpath(''));
        $dompdf = new Dompdf($options);
        $html = view('hotel.booking.pdf', ['hotelBooking' => $hotelBooking])->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream('hotelBooking.pdf');
    }
    public function allHotelBookingGetreport(array $data)
    {
        $hotelBooks = $this->hotelBooking->query();
        //filter by date
        if (!empty($data['date_range'])) {
            $dateRange = explode(' - ', $data['date_range']);
            $startDate = Carbon::createFromFormat('m/d/Y', trim($dateRange[0]))->startOfDay();
            $endDate = Carbon::createFromFormat('m/d/Y', trim($dateRange[1]))->endOfDay();
            $hotelBooks->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate])
                    ->orWhereDate('created_at', $startDate);
            });
        }
        //search data
        if (!empty($data['searchData'])) {
            $search = $data['searchData'];
            $hotelBooks->where(function ($query) use ($search) {
                $query->where('booking_code', 'LIKE', "%{$search}%")
                    ->orWhere('hotel_code', 'LIKE', "%{$search}%")
                    ->orWhere('room_no', 'LIKE', "%{$search}%");
            });
        }
        $perPage = isset($data['perPage']) ? intval($data['perPage']) : 3;
        return $hotelBooks->paginate($perPage);
    }
}
