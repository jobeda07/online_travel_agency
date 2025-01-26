<?php

namespace App\Infra\Repositories;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Point;
use App\Models\AccountLedger;
use App\Models\AirTicketBooking;

class AirTicketBookingRepository
{
    private AirTicketBooking $airTicketBooking;
    private Point $point;

    public function __construct(AirTicketBooking $airTicketBooking, Point $point)
    {
        $this->airTicketBooking = $airTicketBooking;
        $this->point = $point;
    }

    public function allAirTicketBookingGet()
    {
        $bookings = $this->airTicketBooking->get();
        return $bookings;
    }

    public function storeAirTicketBooking(array $data)
    {
        //dd($data['point_discount'] );
        $pointDiscount = $this->calculatePointDiscount($data['point_discount'] ?? 0);
        $airTicketBooking = new AirTicketBooking();
        $airTicketBooking->customer_id = $data['customer_id'];
        $airTicketBooking->booking_code = $data['booking_code'];
        $airTicketBooking->ticket_code = $data['ticket_code'];
        $airTicketBooking->airline_code = $data['airline_code'];
        $airTicketBooking->travel_date = $data['travel_date'];
        $airTicketBooking->return_date = $data['return_date'];
        $airTicketBooking->pnr = $data['pnr'];
        $airTicketBooking->way_type = 1;
        $airTicketBooking->country_id = $data['country_id'];
        $airTicketBooking->city_id = $data['city_id'];
        $airTicketBooking->no_of_adult = $data['no_of_adult'];
        $airTicketBooking->no_of_child = $data['no_of_child'];
        $airTicketBooking->adult_base_price = $data['adult_base_price'];
        $airTicketBooking->child_base_price = $data['child_base_price'];
        $airTicketBooking->total_price = ($data['adult_base_price'] * $data['no_of_adult']) + ($data['child_base_price'] * $data['no_of_child']);
        $airTicketBooking->discount_amount = $data['discount_amount'];
        $airTicketBooking->vat = $data['vat'];
        $airTicketBooking->extra_charge = $data['extra_charge'];
        $airTicketBooking->extra_charge_details = $data['extra_charge_details'];
        $airTicketBooking->point_discount = $pointDiscount;
        $airTicketBooking->grand_total = round($airTicketBooking->total_price + $data['vat'] + $data['extra_charge'] - $data['discount_amount'] - $pointDiscount);
        $airTicketBooking->paid_amount = $data['paid_amount'];
        $airTicketBooking->status = 1;
        $airTicketBooking->payment_status = 0;
        $airTicketBooking->payment_method = $data['payment_method'];
        $airTicketBooking->payment_details = $data['payment_details'];
        $airTicketBooking->save();

        if ($airTicketBooking->point_discount > 0) {
            $this->deductCustomerPoints($airTicketBooking->id, $data['point_discount'] ?? 0);
        }

        $this->rewardCustomerPoints($airTicketBooking->id);
        if ($airTicketBooking->paid_amount > 0) {
            $this->accountLedger($airTicketBooking->id);
        }
        return $airTicketBooking;
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

        $airTicketBooking = $this->airTicketBooking->findOrFail($id);
        $remainingAmountToDeduct = $data;

        $customerPoints = $this->point->where('customer_id', $airTicketBooking->customer_id)
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
        $airTicketBooking = $this->airTicketBooking->findOrFail($id);
        $settingPurAmount = get_setting('purchase_amount')->value ?? 1000;
        $settingPoint = get_setting('purchase_amount_point')->value ?? 100;
        if ($airTicketBooking->grand_total >= $settingPurAmount) {
            $takeCount = floor($airTicketBooking->grand_total / $settingPurAmount);
            Point::create([
                'customer_id'   => $airTicketBooking->customer_id,
                'booking_id'    => $airTicketBooking->id,
                'booking_type'  => 1,
                'amount'        => $settingPoint * $takeCount,
                'used_amount'   => $settingPoint * $takeCount,
                'validity'      => now()->addDays(45),
            ]);
        }
    }
    private function accountLedger($id)
    {
        $airTicketBooking = $this->airTicketBooking->findOrFail($id);
        $amount = get_account_balance();
        $oldAccountLedger = AccountLedger::where('ticket_id', $airTicketBooking->id)
            ->where('ticket_type', 1)
            ->first();
        if ($oldAccountLedger) {
            $creditDifference = $airTicketBooking->paid_amount - $oldAccountLedger->credit;
            $oldAccountLedger->balance += $creditDifference;
            $oldAccountLedger->particulars = 'Air Ticket Booking Code: ' . $airTicketBooking->booking_code;
            $oldAccountLedger->credit = $airTicketBooking->paid_amount;
            $oldAccountLedger->save();
        } else {
            $ledger = AccountLedger::create([
                'account_head_id' => 1,
                'particulars' => 'Air Ticket Booking Code: ' . $airTicketBooking->booking_code,
                'credit' => $airTicketBooking->paid_amount,
                'ticket_id' => $airTicketBooking->id,
                'ticket_type' => 1,
                'account_type' => 2,
            ]);
            $ledger->balance = $amount + $airTicketBooking->paid_amount;
            $ledger->save();
        }
    }

    public function findAirTicketBookingById($id)
    {
        return $this->airTicketBooking->findOrFail($id);
    }

    public function updateAirTicketBooking($id, array $data)
    {
        $airTicketBooking = $this->findAirTicketBookingById($id);
        $airTicketBooking->customer_id = $data['customer_id'];
        $airTicketBooking->booking_code = $data['booking_code'];
        $airTicketBooking->ticket_code = $data['ticket_code'];
        $airTicketBooking->airline_code = $data['airline_code'];
        $airTicketBooking->travel_date = $data['travel_date'];
        $airTicketBooking->return_date = $data['return_date'];
        $airTicketBooking->pnr = $data['pnr'];
        $airTicketBooking->way_type = $airTicketBooking->way_type;
        $airTicketBooking->country_id = $data['country_id'];
        $airTicketBooking->city_id = $data['city_id'];
        $airTicketBooking->no_of_adult = $data['no_of_adult'];
        $airTicketBooking->no_of_child = $data['no_of_child'];
        $airTicketBooking->adult_base_price = $data['adult_base_price'];
        $airTicketBooking->child_base_price = $data['child_base_price'];
        $airTicketBooking->total_price = ($data['adult_base_price'] * $data['no_of_adult']) + ($data['child_base_price'] * $data['no_of_child']);
        $airTicketBooking->discount_amount = $data['discount_amount'];
        $airTicketBooking->vat = $data['vat'];
        $airTicketBooking->extra_charge = $data['extra_charge'];
        $airTicketBooking->extra_charge_details = $data['extra_charge_details'];

        $airTicketBooking->grand_total = $airTicketBooking->total_price + $data['vat'] + $data['extra_charge'] - $data['discount_amount'] - $airTicketBooking->point_discount;

        $airTicketBooking->paid_amount = $data['paid_amount'];
        $airTicketBooking->status = $airTicketBooking->status;
        $airTicketBooking->payment_status = $airTicketBooking->payment_status;
        $airTicketBooking->payment_method = $data['payment_method'];
        $airTicketBooking->payment_details = $data['payment_details'];
        $airTicketBooking->save();
        if ($airTicketBooking->paid_amount > 0) {
            $this->accountLedger($airTicketBooking->id);
        }
        return $airTicketBooking;
    }
    public function deleteAirTicketBooking($id)
    {
        $airTicketBooking = $this->airTicketBooking->find($id);
        if ($airTicketBooking) {
            return $airTicketBooking->delete();
        }
    }
    public function statusAirTicketBooking($id)
    {
        $airTicketBooking = $this->airTicketBooking->find($id);
        $airTicketBooking->status = $airTicketBooking->status == 1 ? 0 : 1;
        $airTicketBooking->save();
        return $airTicketBooking;
    }
    public function pdfAirTicketBookingById($id)
    {
        $airTicketBooking = $this->airTicketBooking->find($id);
        if (!$airTicketBooking) {
            abort(404, 'Booking not found.');
        }
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('chroot', realpath(''));
        $dompdf = new Dompdf($options);
        $html = view('airTicket.booking.pdf', ['airTicketBooking' => $airTicketBooking])->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream('airTicketBooking.pdf');
    }

    public function allAirTicketBookingreport(array $data)
    {
        $bookings = $this->airTicketBooking->query();
        //filter by date
        if (!empty($data['date_range'])) {
            $dateRange = explode(' - ', $data['date_range']);
            $startDate = Carbon::createFromFormat('m/d/Y', trim($dateRange[0]))->startOfDay();
            $endDate = Carbon::createFromFormat('m/d/Y', trim($dateRange[1]))->endOfDay();
            $bookings->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate])
                    ->orWhereDate('created_at', $startDate);
            });
        }
        //search data
        if (!empty($data['searchData'])) {
            $search = $data['searchData'];
            $bookings->where(function ($query) use ($search) {
                $query->where('booking_code', 'LIKE', "%{$search}%")
                    ->orWhere('airline_code', 'LIKE', "%{$search}%")
                    ->orWhere('ticket_code', 'LIKE', "%{$search}%");
            });
        }
        $perPage = isset($data['perPage']) ? intval($data['perPage']) : 3;
        return $bookings->paginate($perPage);
    }
}
