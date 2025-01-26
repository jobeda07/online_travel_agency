<?php

namespace App\Infra\Services;

use App\Infra\Repositories\CustomerRepository;

class CustomerService
{
    private CustomerRepository $customerRepository;
    /**
     * @param CustomerRepository $customerRepository
     */
    public function __construct(
        CustomerRepository $customerRepository,
    ) {
        $this->customerRepository = $customerRepository;
    }

    public function allCustomerGet()
    {
        $customers = $this->customerRepository->allCustomerGet();
        return $customers;
    }
    public function storeCustomer(array $data)
    {
        return $this->customerRepository->storeCustomer($data);
    }
    public function findCustomerById($id)
    {
        return $this->customerRepository->findCustomerById($id);
    }

    public function updateCustomer($id, array $data)
    {
        return $this->customerRepository->updateCustomer($id, $data);
    }
    public function deleteCustomer($id)
    {
        return $this->customerRepository->deleteCustomer($id);
    }
}
