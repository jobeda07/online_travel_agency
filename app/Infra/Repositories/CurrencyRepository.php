<?php

namespace App\Infra\Repositories;

use App\Models\Currency;

class CurrencyRepository
{
    private Currency $currency;

    public function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }

    public function allCurrencyGet()
    {
        $cities = $this->currency->get();
        return $cities;
    }
    public function storeCurrency(array $data)
    {
        $currency = new Currency();
        $currency->name = $data['name'];
        $currency->country_id = $data['country_id'];
        $currency->save();
        return $currency;
    }

    public function findCurrencyById($id)
    {
        return $this->currency->findOrFail($id);
    }

    public function updateCurrency($id, array $data)
    {
        $currency = $this->findCurrencyById($id);
        $currency->name = $data['name'];
        $currency->country_id = $data['country_id'];
        $currency->status = $currency->status;
        $currency->save();
        return $currency;
    }
    public function deleteCurrency( $id)
    {
        $currency = $this->currency->find($id);
        if ($currency) {
            return $currency->delete();
        }
    }
    public function statusCurrency( $id)
    {
        $currency = $this->currency->find($id);
        $currency->status = $currency->status == 1 ? 0 : 1;
        $currency->save();
        return $currency;
    }
}
