<?php

namespace App\Http\Controllers\Common;

use Exception;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use App\Infra\Services\CityService;
use App\Http\Controllers\Controller;

class CityAction extends Controller
{
    private CityService $cityService;

    public function __construct(CityService $cityService)
    {
       $this->cityService=$cityService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['cities']=$this->cityService->allCityGet();
         return view('common.city.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['countries']=Country::where('status',1)->get();
        return view('common.city.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $data)
    {
        try{
            $this->cityService->storeCity($data->validated());
            return redirect()->route('city.list')->with('success', 'City Create successfully.');
          }catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to Store City.');
          }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['city']=$this->cityService->findCityById($id);
        $data['countries']=Country::where('status',1)->get();
        return view('common.city.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $data, string $id)
    {

        try {
            $this->cityService->updateCity($id, $data->validated());
            return redirect()->route('city.list')->with('success', 'City updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update City.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->cityService->deleteCity($id);
            return redirect()->route('city.list')->with('success', 'City deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete City.');
        }
    }
    public function status(string $id)
    {
        try {
            $this->cityService->statusCity($id);
            return redirect()->back()->with('success', 'Status Update successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Update.');
        }
    }
}
