<?php

namespace App\Infra\Repositories;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerRepository
{
    private Customer $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function allCustomerGet()
    {
        $customers = $this->customer->get();
        return $customers;
    }
    public function storeCustomer(array $data)
    {
        $customer = new Customer();
        $customer->first_name = $data['first_name'];
        $customer->last_name = $data['last_name'];
        $customer->phone = $data['phone'];
        $customer->email = $data['email'];
        $customer->password = Hash::make($data['password']);
        $customer->username = $data['username'];
        $customer->address = $data['address'];
        $customer->save();
        return $customer;
    }

    public function findCustomerById($id)
    {
        return $this->customer->findOrFail($id);
    }

    public function updateCustomer($id, array $data)
    {
        $customer = $this->findCustomerById($id);
        $customer->first_name = $data['first_name'];
        $customer->last_name = $data['last_name'];
        $customer->phone = $data['phone'];
        $customer->email = $data['email'];
        $customer->username = $data['username'];
        $customer->address = $data['address'];
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $customer->save();
        return $customer;
    }
    public function deleteCustomer( $id)
    {
        $customer = $this->customer->find($id);
        if ($customer) {
            return $customer->delete();
        }
    }
}
