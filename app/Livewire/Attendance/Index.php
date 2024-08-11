<?php

namespace App\Livewire\Attendance;

use App\Models\Attendance;
use Livewire\Component;

class Index extends Component
{

    public function render()
    {   
        $attendances = Attendance::whereDate('date', now())->latest()->paginate(20);
        return view('livewire.attendance.index', compact('attendances'));
    }
}
