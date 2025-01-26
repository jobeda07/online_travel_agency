<?php

namespace App\Infra\Repositories;

use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use App\Models\SupportTicket;
use App\Models\SupportTicketMessage;

class SupportTicketRepository
{
    use ImageUpload;
    private SupportTicket $supportTicket;

    public function __construct(SupportTicket $supportTicket)
    {
        $this->supportTicket = $supportTicket;
    }

    public function allSupportTicketGet()
    {
        $support_tickets = $this->supportTicket->get();
        return $support_tickets;
    }
    public function storeSupportTicket(array $data)
    {
        //dd($data);
        $supportTicket = new SupportTicket();
        $supportTicket->token = Str::random(6);
        $supportTicket->send_by = 1;
        $supportTicket->save();

        $message = new SupportTicketMessage();
        $message->message = $data['message'];
        $message->send_by_customer = 1;
        $message->support_ticket_id = $supportTicket->id;
        if (array_key_exists('image', $data)) {
            $images = [];
            foreach ($data['image'] as $file_data) {
                $filename = $this->imageUpload($file_data, 500, 500, 'uploads/images/SupportTicketMessageImage/', true);
                $images[] = 'uploads/images/SupportTicketMessageImage/' . $filename;
            }
            $message->image = json_encode($images);
        }
        if (array_key_exists('attachment', $data)) {
            $fileadd = time() . '.' . $data['attachment']->getclientOriginalExtension();
            $data['attachment']->move(public_path('uploads/attachment/SupportMessagePDF/'), $fileadd);
            $message->attachment = "uploads/attachment/SupportMessagePDF/" . $fileadd;
        }
        $message->save();
        return $supportTicket;
    }

    public function findSupportTicketById($id)
    {
        return $this->supportTicket->findOrFail($id);
    }

    public function storeSupportTicketMessage($id, array $data)
    {
        $message = new SupportTicketMessage();
        $message->message = $data['message'];
        $message->send_by_customer = 1;
        $message->support_ticket_id = $id;
        if (array_key_exists('image', $data)) {
            $images = [];
            foreach ($data['image'] as $file_data) {
                $filename = $this->imageUpload($file_data, 500, 500, 'uploads/images/SupportTicketMessageImage/', true);
                $images[] = 'uploads/images/SupportTicketMessageImage/' . $filename;
            }
            $message->image = json_encode($images);
        }
        if (array_key_exists('attachment', $data)) {
            $fileadd = time() . '.' . $data['attachment']->getclientOriginalExtension();
            $data['attachment']->move(public_path('uploads/attachment/SupportMessagePDF/'), $fileadd);
            $message->attachment = "uploads/attachment/SupportMessagePDF/" . $fileadd;
        }
        $message->save();
        return $message;
    }
}
