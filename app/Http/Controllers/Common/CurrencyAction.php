<?php

namespace App\Http\Controllers\Common;

use Exception;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;
use App\Infra\Services\CurrencyService;

class CurrencyAction extends Controller
{
    private CurrencyService $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
       $this->currencyService=$currencyService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['currencies']=$this->currencyService->allCurrencyGet();
        return view('common.currency.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['countries']=Country::where('status',1)->get();
        return view('common.currency.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CurrencyRequest $data)
    {
        try{
            $this->currencyService->storeCurrency($data->validated());
            return redirect()->route('currency.list')->with('success', 'Currency Create successfully.');
          }catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to Store Currency.');
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
        $data['currency']=$this->currencyService->findCurrencyById($id);
        $data['countries']=Country::where('status',1)->get();
        return view('common.currency.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CurrencyRequest $data, string $id)
    {

        try {
            $this->currencyService->updateCurrency($id, $data->validated());
            return redirect()->route('currency.list')->with('success', 'Currency updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Currency.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->currencyService->deleteCurrency($id);
            return redirect()->route('currency.list')->with('success', 'Currency deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Currency.');
        }
    }
    public function status(string $id)
    {
        try {
            $this->currencyService->statusCurrency($id);
            return redirect()->back()->with('success', 'Status Update successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Update.');
        }
    }
}
