<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Infra\Services\SliderService;
use Exception;
use Illuminate\Http\Request;

class SliderAction extends Controller
{
    private SliderService $SliderService;
    public function __construct(SliderService $SliderService)
    {
       $this->SliderService=$SliderService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['sliders']=$this->SliderService->allSliderGet();
       // dd($data['countries']);
        return view('common.slider.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $data)
    {
       try{
         $this->SliderService->storeSlider($data->validated());
         return redirect()->route('slider.list')->with('success', 'Slider Create successfully.');
       }catch(Exception $e){
         return redirect()->back()->with('error', 'Failed to Store Slider.');
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
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $data, string $id)
    {
        // try {
            $this->SliderService->updateSlider($id, $data->validated());
            return redirect()->route('slider.list')->with('success', 'Slider updated successfully.');
        // } catch (Exception $e) {
        //     return redirect()->back()->with('error', 'Failed to update Slider.');
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->SliderService->deleteSlider($id);
            return redirect()->route('slider.list')->with('success', 'Slider deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Slider.');
        }
    }
    public function status(string $id)
    {
        try {
            $this->SliderService->statusSlider($id);
            return redirect()->back()->with('success', 'Status Update successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Update.');
        }
    }
}
