<?php

namespace App\Infra\Services;

use App\Infra\Repositories\AirTicketBookingRepository;

class AirTicketBookingService
{
    private AirTicketBookingRepository $airTicketBookingRepository;

    public function __construct(
        AirTicketBookingRepository $airTicketBookingRepository,
    ) {
        $this->airTicketBookingRepository = $airTicketBookingRepository;
    }
    public function allAirTicketBookingGet()
    {
        $airTicketBooks = $this->airTicketBookingRepository->allAirTicketBookingGet();
        return $airTicketBooks;
    }
    public function storeAirTicketBooking(array $data)
    {
        return $this->airTicketBookingRepository->storeAirTicketBooking($data);
    }
    public function findAirTicketBookingById($id)
    {
        return $this->airTicketBookingRepository->findAirTicketBookingById($id);
    }
    public function updateAirTicketBooking($id, array $data)
    {
        return $this->airTicketBookingRepository->updateAirTicketBooking($id, $data);
    }
    public function deleteAirTicketBooking($id)
    {
        return $this->airTicketBookingRepository->deleteAirTicketBooking($id);
    }
    public function statusAirTicketBooking($id)
    {
        return $this->airTicketBookingRepository->statusAirTicketBooking($id);
    }
    public function pdfAirTicketBookingById($id)
    {
        return $this->airTicketBookingRepository->pdfAirTicketBookingById($id);
    }
    public function allAirTicketBookingreport(array $data)
    {
        $airTicketBooks = $this->airTicketBookingRepository->allAirTicketBookingreport($data);
        return $airTicketBooks;
    }
}
