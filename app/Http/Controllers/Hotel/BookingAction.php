<?php

namespace App\Http\Controllers\Hotel;

use Exception;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use App\Enums\RoomTypeEnum;
use App\Enums\PaymentMethodEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\HotelBookingRequest;
use App\Infra\Services\HotelBookingService;

class BookingAction extends Controller
{
    private HotelBookingService $hotelBookingService;

    public function __construct(HotelBookingService $hotelBookingService)
    {
       $this->hotelBookingService=$hotelBookingService;
       $this->middleware('auth:admin');
       $this->middleware('permission:hotelticket-list', ['only' => ['index']]);
       $this->middleware('permission:hotelticket-create', ['only' => ['create','store']]);
       $this->middleware('permission:hotelticket-edit', ['only' => ['update','edit']]);
       $this->middleware('permission:hotelticket-show', ['only' => ['show','pdf_download']]);
       $this->middleware('permission:hotelticket-delete', ['only' => ['destroy']]);
       $this->middleware('permission:hotelticket-report', ['only' => ['reports']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['hotelBooks']=$this->hotelBookingService->allHotelBookingGet();
        return view('hotel.booking.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['customers']=Customer::latest()->get();
        $data['countries']=Country::where('status',1)->get();
        $data['cities']=City::where('status',1)->get();
        $data['payment_methods']=PaymentMethodEnum::cases();
        $data['room_types']=RoomTypeEnum::cases();
        return view('hotel.booking.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HotelBookingRequest $data)
    {
       // dd($data);
        try{
            $this->hotelBookingService->storeHotelBooking($data->validated());
            return redirect()->route('hotel.booking.list')->with('success', 'HotelBooking Create successfully.');
        }catch(Exception $e){
           return redirect()->back()->with('error', 'Failed to Store HotelBooking.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['hotelBook']=$this->hotelBookingService->findHotelBookingById($id);
        return view('hotel.booking.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['hotelBook']=$this->hotelBookingService->findHotelBookingById($id);
        $data['customers']=Customer::latest()->get();
        $data['countries']=Country::where('status',1)->get();
        $data['cities']=City::where('country_id',$data['hotelBook']->country_id)->where('status',1)->get();
        $data['payment_methods']=PaymentMethodEnum::cases();
        $data['room_types']=RoomTypeEnum::cases();
        return view('hotel.booking.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HotelBookingRequest $data, string $id)
    {
        try {
            $this->hotelBookingService->updateHotelBooking($id, $data->validated());
            return redirect()->route('hotel.booking.list')->with('success', 'HotelBooking updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update HotelBooking.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->hotelBookingService->deleteHotelBooking($id);
            return redirect()->back()->with('success', 'HotelBooking deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete HotelBooking.');
        }
    }
    public function status(string $id)
    {
        try {
            $this->hotelBookingService->statusHotelBooking($id);
            return redirect()->back()->with('success', 'Status Update successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Update.');
        }
    }

    public function pdf_download(string $id)
    {
        $data['hotelBooking']=$this->hotelBookingService->pdfHotelBookingById($id);
        return redirect()->back();
    }
    public function reports(Request $request)
    {
        $hotelBooks = $this->hotelBookingService->allHotelBookingGetreport($request->all());
        if ($request->ajax()) {
            return view('hotel.booking.report.list', compact('hotelBooks'))->render();
        }
        return view('hotel.booking.report.reports', compact('hotelBooks'));
    }
}
