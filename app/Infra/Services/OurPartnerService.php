<?php

namespace App\Infra\Services;

use App\Infra\Repositories\OurPartnerRepository;

class OurPartnerService
{
    private OurPartnerRepository $OurPartnerRepository;

    public function __construct(
        OurPartnerRepository $OurPartnerRepository,
    ) {
        $this->OurPartnerRepository = $OurPartnerRepository;
    }

    public function allOurPartnerGet()
    {
        $cities = $this->OurPartnerRepository->allOurPartnerGet();
        return $cities;
    }
    public function storeOurPartner(array $data)
    {
        return $this->OurPartnerRepository->storeOurPartner($data);
    }
    public function findOurPartnerById($id)
    {
        return $this->OurPartnerRepository->findOurPartnerById($id);
    }

    public function updateOurPartner($id, array $data)
    {
        return $this->OurPartnerRepository->updateOurPartner($id, $data);
    }
    public function deleteOurPartner($id)
    {
        return $this->OurPartnerRepository->deleteOurPartner($id);
    }
    public function statusOurPartner($id)
    {
        return $this->OurPartnerRepository->statusOurPartner($id);
    }
}
