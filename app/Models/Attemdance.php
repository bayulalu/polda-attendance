<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Attemdance extends Model
{
    use HasFactory, Notifiable;

    const APPROVE = 1;
    const REJECT = 0;

    protected $fillable = [
        'type',
        'file_assignment',
        'foto',
        'check_in',
        'check_out',
        'user_id',
        'settings_id',
        'date',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
