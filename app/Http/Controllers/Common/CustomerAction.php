<?php

namespace App\Http\Controllers\Common;

use Exception;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CustomerRequest;
use App\Infra\Services\CustomerService;

class CustomerAction extends Controller
{
    private CustomerService $customerService;
    /**
     * Create a new controller instance.
     *
     * @param CustomerService $customerService
     * @return void
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['customers'] = $this->customerService->allCustomerGet();
        return view('common.customer.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('common.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $data)
    {
        try {
            $this->customerService->storeCustomer($data->validated());
            return redirect()->route('customer.list')->with('success', 'Customer Create successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Store customer.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['customer'] = $this->customerService->findCustomerById($id);
        return view('common.customer.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['customer'] = $this->customerService->findCustomerById($id);
        return view('common.customer.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:80',
            'last_name' => 'required|string|max:80',
            'phone' => 'required|digits:11|unique:customers,phone,' . $id,
            'email' => 'required|email|unique:customers,email,' . $id,
            'username' => 'required|string|max:20|unique:customers,username,' . $id,
            'password' => 'nullable|string|min:6|max:20',
            'address' => 'required|max:700',
        ]);
        try {
            $this->customerService->updateCustomer($id, $validatedData);
            return redirect()->route('customer.list')->with('success', 'Customer updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update customer.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->customerService->deleteCustomer($id);
            return redirect()->route('customer.list')->with('success', 'Customer deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete customer.');
        }
    }
}
