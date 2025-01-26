<?php

namespace App\Infra\Services;

use App\Infra\Repositories\CurrencyRepository;

class CurrencyService
{
    private CurrencyRepository $currencyRepository;

    public function __construct(
        CurrencyRepository $currencyRepository,
    ) {
        $this->currencyRepository = $currencyRepository;
    }

    public function allCurrencyGet()
    {
        $customers = $this->currencyRepository->allCurrencyGet();
        return $customers;
    }
    public function storeCurrency(array $data)
    {
        return $this->currencyRepository->storeCurrency($data);
    }
    public function findCurrencyById($id)
    {
        return $this->currencyRepository->findCurrencyById($id);
    }

    public function updateCurrency($id, array $data)
    {
        return $this->currencyRepository->updateCurrency($id, $data);
    }
    public function deleteCurrency($id)
    {
        return $this->currencyRepository->deleteCurrency($id);
    }
    public function statusCurrency($id)
    {
        return $this->currencyRepository->statusCurrency($id);
    }
}
