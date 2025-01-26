<?php

namespace App\Http\Controllers\Common;

use App\Models\City;
use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\HolidayPackageRequest;
use App\Infra\Services\HolidayPackageService;

class HolidayPackageAction extends Controller
{
    private HolidayPackageService $holidayPackageService;
    
    public function __construct(HolidayPackageService $holidayPackageService){
        $this->holidayPackageService=$holidayPackageService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['holidayPackages']=$this->holidayPackageService->allHolidayPackageGet();
        return view('common.package.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['countries']=Country::where('status',1)->get();
        $data['cities']=City::where('status',1)->get();
        return view('common.package.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HolidayPackageRequest $data)
    {
        try{
            $this->holidayPackageService->storeHolidayPackage($data->validated());
            return redirect()->route('holiday.package.list')->with('success', 'Holiday Package Create successfully.');
          }catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to Store package.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $data['holidayPackage']=$this->holidayPackageService->findHolidayPackageById($id);
            return view('common.package.show',$data);
          } catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to find package.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $data['holidayPackage']=$this->holidayPackageService->findHolidayPackageById($id);
            $data['countries']=Country::where('status',1)->get();
            $data['cities']=City::where('status',1)->get();
            return view('common.package.create',$data);
          } catch(Exception $e) {
            return redirect()->back()->with('error', 'Failed to find package.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $this->holidayPackageService->updateHolidayPackage($id,$request->all());
            return redirect()->route('holiday.package.list')->with('success', 'Holiday Package Create successfully.');
          }catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to update package.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->holidayPackageService->deleteHolidayPackage($id);
            return redirect()->route('holiday.package.list')->with('success', 'Holiday Package deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Holiday Package.');
        }
    }

    public function status(string $id)
    {
        try {
            $this->holidayPackageService->statusHolidayPackage($id);
            return redirect()->back()->with('success', 'Status Update successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Update.');
        }
    }
}
