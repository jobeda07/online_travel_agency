<?php

namespace App\Infra\Repositories;

use App\Models\OurPartner;
use App\Traits\ImageUpload;
use Illuminate\Support\Facades\Hash;

class OurPartnerRepository
{
    use ImageUpload;
    private OurPartner $OurPartner;

    public function __construct(OurPartner $OurPartner)
    {
        $this->OurPartner = $OurPartner;
    }

    public function allOurPartnerGet()
    {
        $our_partners = $this->OurPartner->get();
        return $our_partners;
    }
    public function storeOurPartner(array $data)
    {
        $filename = "";
        $OurPartner = new OurPartner();
        $OurPartner->name = $data['name'];
        $OurPartner->status = 1;
        if (array_key_exists('image', $data)){
            $filename = $this->imageUpload($data['image'], 220, 115, 'uploads/images/OurPartner/', true);
            $OurPartner->image ='uploads/images/OurPartner/'.$filename;
        }
        $OurPartner->save();
        return $OurPartner;
    }

    public function findOurPartnerById($id)
    {
        return $this->OurPartner->findOrFail($id);
    }

    public function updateOurPartner($id, array $data)
    {
        $filename = "";
        $OurPartner = $this->findOurPartnerById($id);
        $OurPartner->name = $data['name'] ?? $OurPartner->name;
        $OurPartner->status =$OurPartner->status;
        if (array_key_exists('image', $data)){
            $this->deleteOne($OurPartner->image);
            $filename = $this->imageUpload($data['image'], 220, 115, 'uploads/images/OurPartner/', true);
            $OurPartner->image ='uploads/images/OurPartner/'.$filename;
        }else{
            $OurPartner->image=$OurPartner->image;
        }
        $OurPartner->save();
        return $OurPartner;
    }
    public function deleteOurPartner( $id)
    {
        $OurPartner = $this->OurPartner->find($id);
        if ($OurPartner) {
            $this->deleteOne($OurPartner->image);
            return $OurPartner->delete();
        }
    }
    public function statusOurPartner( $id)
    {
        $OurPartner = $this->OurPartner->find($id);
        $OurPartner->status = $OurPartner->status == 1 ? 0 : 1;
        $OurPartner->save();
        return $OurPartner;
    }
}