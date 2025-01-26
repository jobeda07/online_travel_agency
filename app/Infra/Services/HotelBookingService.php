<?php

namespace App\Infra\Services;

use App\Infra\Repositories\HotelBookingRepository;

class HotelBookingService
{
    private HotelBookingRepository $hotelBookingRepository;

    public function __construct(
        HotelBookingRepository $hotelBookingRepository,
    ) {
        $this->hotelBookingRepository = $hotelBookingRepository;
    }
    public function allHotelBookingGet()
    {
        $hotelBooks = $this->hotelBookingRepository->allHotelBookingGet();
        return $hotelBooks;
    }
    public function storeHotelBooking(array $data)
    {
        return $this->hotelBookingRepository->storeHotelBooking($data);
    }
    public function findHotelBookingById($id)
    {
        return $this->hotelBookingRepository->findHotelBookingById($id);
    }
    public function updateHotelBooking($id, array $data)
    {
        return $this->hotelBookingRepository->updateHotelBooking($id, $data);
    }
    public function deleteHotelBooking($id)
    {
        return $this->hotelBookingRepository->deleteHotelBooking($id);
    }
    public function statusHotelBooking($id)
    {
        return $this->hotelBookingRepository->statusHotelBooking($id);
    }
    public function pdfHotelBookingById($id)
    {
        return $this->hotelBookingRepository->pdfHotelBookingById($id);
    }
    public function allHotelBookingGetreport(array $data)
    {
        $airTicketBooks = $this->hotelBookingRepository->allHotelBookingGetreport($data);
        return $airTicketBooks;
    }
}
