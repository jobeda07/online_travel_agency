<?php

namespace App\Infra\Repositories;

use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use App\Models\SupportTicket;
use App\Models\SupportTicketMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminSupportTicketRepository
{
    use ImageUpload;
    private SupportTicket $supportTicket;

    public function __construct(SupportTicket $supportTicket)
    {
        $this->supportTicket = $supportTicket;
    }

    // public function allSupportTicketGet()
    // {
    //     $support_tickets = $this->supportTicket->get();
    //     return $support_tickets;

    // }
    public function allSupportTicketGet()
    {
        $userId = Auth::guard('admin')->user()->id;
        $support_tickets = $this->supportTicket
            // ->where('assigned_to', $userId)
            // ->orWhereNull('assigned_to')
            ->get();
        return $support_tickets;
    }


    public function findSupportTicketById($id)
    {
        return $this->supportTicket->findOrFail($id);
    }
    public function updateSupportTicket($id, array $data)
    {
        $supportTicket = $this->findSupportTicketById($id);
        $supportTicket->assigned_to = $data['assigned_to'];
        $supportTicket->save();
        return $supportTicket;
    }


    public function deleteSupportTicket($id)
    {
        $supportTicket = $this->supportTicket->find($id);
        $messages = SupportTicketMessage::where('support_ticket_id', $supportTicket->id)->get();
        foreach ($messages as $message) {
            $images = json_decode($message->image, true);
            if ($images && is_array($images)) {
                foreach ($images as $img) {
                    //dd($img);
                    $this->deleteOne($img);
                }
            }
            if ($message->attachment) {
                $removefile = public_path($message->attachment);
                File::delete($removefile);
            }
            $message->delete();
        }
        return $supportTicket->delete();
    }

    public function storeSupportTicketMessage($id, array $data)
    {
        //dd($data);
        $message = new SupportTicketMessage();
        $message->message = $data['message'];
        $message->send_by_adminUser = Auth::guard('admin')->user()->id;
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
