<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;
    protected $table = 'support_tickets';
    public function support_message()
    {
        return $this->hasMany(SupportTicketMessage::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class ,'assigned_to');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class ,'send_by');
    }
}
