<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'sms_message_id',
        'user_id',
        'status',
        'sent_at',
    ];

    protected $dates = ['sent_at'];

    public function smsMessage()
    {
        return $this->belongsTo(SmsMessage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
