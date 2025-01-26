<?php

namespace App\Http\Controllers\AirTicket;

use Exception;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enums\PaymentMethodEnum;
use App\Http\Requests\AirTicketBookingRequest;
use App\Infra\Services\AirTicketBookingService;

class BookingAction extends Controller
{
    private AirTicketBookingService $airTicketBookingService;

    public function __construct(AirTicketBookingService $airTicketBookingService)
    {
       $this->airTicketBookingService=$airTicketBookingService;
       $this->middleware('auth:admin');
       $this->middleware('permission:airticket-list', ['only' => ['index']]);
       $this->middleware('permission:airticket-create', ['only' => ['create','store']]);
       $this->middleware('permission:airticket-edit', ['only' => ['update','edit']]);
       $this->middleware('permission:airticket-show', ['only' => ['show','pdf_download']]);
       $this->middleware('permission:airticket-delete', ['only' => ['destroy']]);
       $this->middleware('permission:airticket-report', ['only' => ['reports']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['airTicketBooks']=$this->airTicketBookingService->allAirTicketBookingGet();
        return view('airTicket.booking.list',$data);
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
        return view('airTicket.booking.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AirTicketBookingRequest $data)
    {
       // try{
            $this->airTicketBookingService->storeAirTicketBooking($data->validated());
            return redirect()->route('airticket.booking.list')->with('success', 'AirTicketBooking Create successfully.');
        // }catch(Exception $e){
        //    return redirect()->back()->with('error', 'Failed to Store AirTicketBooking.');
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['airTicketBook']=$this->airTicketBookingService->findAirTicketBookingById($id);
        return view('airTicket.booking.show',$data);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['airTicketBook']=$this->airTicketBookingService->findAirTicketBookingById($id);
        $data['customers']=Customer::latest()->get();
        $data['countries']=Country::where('status',1)->get();
        $data['cities']=City::where('country_id',$data['airTicketBook']->country_id)->where('status',1)->get();
        $data['payment_methods']=PaymentMethodEnum::cases();
        return view('airTicket.booking.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AirTicketBookingRequest $data, string $id)
    {
        try {
            $this->airTicketBookingService->updateAirTicketBooking($id, $data->validated());
            return redirect()->route('airticket.booking.list')->with('success', 'AirTicketBooking updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update AirTicketBooking.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->airTicketBookingService->deleteAirTicketBooking($id);
            return redirect()->back()->with('success', 'AirTicketBooking deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete AirTicketBooking.');
        }
    }
    public function status(string $id)
    {
        try {
            $this->airTicketBookingService->statusAirTicketBooking($id);
            return redirect()->back()->with('success', 'Status Update successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Update.');
        }
    }

    public function pdf_download(string $id)
    {
        $data['airTicketBooking']=$this->airTicketBookingService->pdfAirTicketBookingById($id);
        return redirect()->back();
    }
    public function reports(Request $request)
    {
        $airTicketBooks = $this->airTicketBookingService->allAirTicketBookingreport($request->all());
        if ($request->ajax()) {
            return view('airTicket.booking.report.list', compact('airTicketBooks'))->render();
        }
        return view('airTicket.booking.report.reports', compact('airTicketBooks'));
    }
}
