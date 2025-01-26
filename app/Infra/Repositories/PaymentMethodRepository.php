<?php

namespace App\Infra\Repositories;

use App\Models\PaymentMethod;
use App\Traits\ImageUpload;
use Illuminate\Support\Facades\Hash;

class PaymentMethodRepository
{
    use ImageUpload;
    private PaymentMethod $payment_method;

    public function __construct(PaymentMethod $payment_method)
    {
        $this->payment_method = $payment_method;
    }

    public function allPaymentMethodGet()
    {
        $payment_methods = $this->payment_method->get();
        return $payment_methods;
    }
    public function storePaymentMethod(array $data)
    {
        $filename = "";
        $payment_method = new PaymentMethod();
        $payment_method->name = $data['name'];
        if (array_key_exists('image', $data)){
            $filename = $this->imageUpload($data['image'], 400, 300, 'uploads/images/PaymentMethodImage/', true);
            $payment_method->image ='uploads/images/PaymentMethodImage/'.$filename;
        }
        $payment_method->save();
        return $payment_method;
    }

    public function findPaymentMethodById($id)
    {
        return $this->payment_method->findOrFail($id);
    }

    public function updatePaymentMethod($id, array $data)
    {
        $filename = "";
        $payment_method = $this->findPaymentMethodById($id);
        $payment_method->name = $data['name'];
        if (array_key_exists('image', $data)){
            $this->deleteOne($payment_method->image);
            $filename = $this->imageUpload($data['image'], 400, 300, 'uploads/images/PaymentMethodImage/', true);
            $payment_method->image ='uploads/images/PaymentMethodImage/'.$filename;
        }else{
            $payment_method->image=$payment_method->image;
        }
        $payment_method->save();
        return $payment_method;
    }
    public function deletePaymentMethod( $id)
    {
        $payment_method = $this->payment_method->find($id);
        if ($payment_method) {
            $this->deleteOne($payment_method->image);
            return $payment_method->delete();
        }
    }
    public function statusPaymentMethod( $id)
    {
        $payment_method = $this->payment_method->find($id);
        $payment_method->status = $payment_method->status == 1 ? 0 : 1;
        $payment_method->save();
        return $payment_method;
    }
}
