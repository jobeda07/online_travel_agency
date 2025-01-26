<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicketMessage extends Model
{
    use HasFactory;
    protected $table = 'support_ticket_messages';
    public function support_ticket()
    {
        return $this->belongsTo(SupportTicket::class,'support_ticket_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class ,'send_by_adminUser');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class ,'send_by_customer');
    }
}
