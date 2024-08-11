<?php

namespace App\Livewire\Attendance;

use App\Models\Attendance;
use Livewire\Component;

class Index extends Component
{
    public $searchTerm;
    
    public function mount()
    {
        $this->searchTerm = now()->format('Y-m-d');
    }

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
        $query = Attendance::whereDate('date', $this->searchTerm);
        $attendances = $query->latest()->paginate(30);

        return view('livewire.attendance.index', compact('attendances'));
    }
}
