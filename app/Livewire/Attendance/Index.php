<?php

namespace App\Livewire\Attendance;

use App\Models\Attendance;
use Livewire\Component;

class Index extends Component
{


    public function statusAttendance($id)
    {
        $attendance = Attendance::find($id);
        $status = Attendance::REJECT;
        if ($attendance->status == Attendance::REJECT) {
            $status = Attendance::APPROVE;
        }

        $attendance->status = $status;
        $attendance->save();
    }

    public function render()
    {   
        $attendances = Attendance::whereDate('date', now())->latest()->paginate(20);
        return view('livewire.attendance.index', compact('attendances'));
    }
}
