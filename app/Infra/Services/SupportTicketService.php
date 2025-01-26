<?php

namespace App\Infra\Services;

use App\Infra\Repositories\SupportTicketRepository;

class SupportTicketService
{
    private SupportTicketRepository $supportTicketRepository;

    public function __construct(
        SupportTicketRepository $supportTicketRepository,
    ) {
        $this->supportTicketRepository = $supportTicketRepository;
    }

    public function allSupportTicketGet()
    {
        $support_tickets = $this->supportTicketRepository->allSupportTicketGet();
        return $support_tickets;
    }
    public function storeSupportTicket(array $data)
    {
        return $this->supportTicketRepository->storeSupportTicket($data);
    }
    public function findSupportTicketById($id)
    {
        return $this->supportTicketRepository->findSupportTicketById($id);
    }

    public function storeSupportTicketMessage($id, array $data)
    {
        return $this->supportTicketRepository->storeSupportTicketMessage($id, $data);
    }
}
