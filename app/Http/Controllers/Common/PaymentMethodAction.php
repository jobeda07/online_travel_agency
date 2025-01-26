<?php

namespace App\Http\Controllers\Common;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethodRequest;
use App\Infra\Services\PaymentMethodService;

class PaymentMethodAction extends Controller
{
    private PaymentMethodService $paymentMethodService;
    public function __construct(PaymentMethodService $paymentMethodService)
    {
       $this->paymentMethodService=$paymentMethodService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['payment_methods']=$this->paymentMethodService->allPaymentMethodGet();
        return view('common.paymentMethod.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('common.paymentMethod.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentMethodRequest $data)
    {
       try{
         $this->paymentMethodService->storePaymentMethod($data->validated());
         return redirect()->route('paymentMethod.list')->with('success', 'PaymentMethod Create successfully.');
       }catch(Exception $e){
         return redirect()->back()->with('error', 'Failed to Store PaymentMethod.');
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
       $data['paymentMethod']=$this->paymentMethodService->findPaymentMethodById($id);
       return view('common.paymentMethod.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:80',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2000',
        ]);
        try {
            $this->paymentMethodService->updatePaymentMethod($id, $validatedData);
            return redirect()->route('paymentMethod.list')->with('success', 'PaymentMethod updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update PaymentMethod.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->paymentMethodService->deletePaymentMethod($id);
            return redirect()->route('paymentMethod.list')->with('success', 'PaymentMethod deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete PaymentMethod.');
        }
    }
    public function status(string $id)
    {
        try {
            $this->paymentMethodService->statusPaymentMethod($id);
            return redirect()->back()->with('success', 'Status Update successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Update.');
        }
    }
}
