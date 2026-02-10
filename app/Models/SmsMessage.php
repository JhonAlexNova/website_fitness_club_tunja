<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'send_at',
        'is_scheduled',
    ];

    protected $dates = ['send_at'];

    public function deliveries()
    {
        return $this->hasMany(SmsDelivery::class);
    }
}
