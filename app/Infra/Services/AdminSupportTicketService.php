<?php

namespace App\Infra\Services;

use App\Infra\Repositories\AdminSupportTicketRepository;

class AdminSupportTicketService
{
    private AdminSupportTicketRepository $supportTicketRepository;

    public function __construct(
        AdminSupportTicketRepository $supportTicketRepository,
    ) {
        $this->supportTicketRepository = $supportTicketRepository;
    }

    public function allSupportTicketGet()
    {
        $support_tickets = $this->supportTicketRepository->allSupportTicketGet();
        return $support_tickets;
    }
    public function findSupportTicketById($id)
    {
        return $this->supportTicketRepository->findSupportTicketById($id);
    }
    public function updateSupportTicket($id, array $data)
    {
        return $this->supportTicketRepository->updateSupportTicket($id, $data);
    }
    public function deleteSupportTicket($id)
    {
        return $this->supportTicketRepository->deleteSupportTicket($id);
    }
    public function storeSupportTicketMessage($id, array $data)
    {
        return $this->supportTicketRepository->storeSupportTicketMessage($id,$data);
    }
}
