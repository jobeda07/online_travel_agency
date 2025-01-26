<?php

namespace App\Infra\Services;

use App\Infra\Repositories\PaymentMethodRepository;

class PaymentMethodService
{
    private PaymentMethodRepository $paymentMethodRepository;
    /**
     * @param PaymentMethodRepository $paymentMethodRepository
     */
    public function __construct(
        PaymentMethodRepository $paymentMethodRepository,
    ) {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function allPaymentMethodGet()
    {
        $payment_methods = $this->paymentMethodRepository->allPaymentMethodGet();
        return $payment_methods;
    }
    public function storePaymentMethod(array $data)
    {
        return $this->paymentMethodRepository->storePaymentMethod($data);
    }
    public function findPaymentMethodById($id)
    {
        return $this->paymentMethodRepository->findPaymentMethodById($id);
    }

    public function updatePaymentMethod($id, array $data)
    {
        return $this->paymentMethodRepository->updatePaymentMethod($id, $data);
    }
    public function deletePaymentMethod($id)
    {
        return $this->paymentMethodRepository->deletePaymentMethod($id);
    }
    public function statusPaymentMethod($id)
    {
        return $this->paymentMethodRepository->statusPaymentMethod($id);
    }
}
