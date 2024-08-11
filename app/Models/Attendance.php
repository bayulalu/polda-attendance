<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Attendance extends Model
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
        'status',
        'file_assignment_out',
        'foto_out'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
