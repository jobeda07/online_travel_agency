<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Infra\Services\CountryService;
use Exception;
use Illuminate\Http\Request;

class CountryAction extends Controller
{
    private CountryService $countryService;
    public function __construct(CountryService $countryService)
    {
       $this->countryService=$countryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['countries']=$this->countryService->allCountryGet();
       // dd($data['countries']);
        return view('common.country.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('common.country.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $data)
    {
       try{
         $this->countryService->storeCountry($data->validated());
         return redirect()->route('country.list')->with('success', 'Country Create successfully.');
       }catch(Exception $e){
         return redirect()->back()->with('error', 'Failed to Store Country.');
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
       $data['country']=$this->countryService->findCountryById($id);
       return view('common.country.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name_en' => 'required|string|max:80',
            'name_bn' => 'required|string|max:80',
            'phone_code' => 'required|max:80|unique:countries,phone_code,' . $id,
            'flag_img' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2000',
        ]);
        try {
            $this->countryService->updateCountry($id, $validatedData);
            return redirect()->route('country.list')->with('success', 'Country updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Country.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->countryService->deleteCountry($id);
            return redirect()->route('country.list')->with('success', 'Country deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Country.');
        }
    }
    public function status(string $id)
    {
        try {
            $this->countryService->statusCountry($id);
            return redirect()->back()->with('success', 'Status Update successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Update.');
        }
    }
}
