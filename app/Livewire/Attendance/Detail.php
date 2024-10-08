<?php

namespace App\Livewire\Attendance;

use App\Models\Attendance;
use Livewire\Component;
use Livewire\WithPagination;

class Detail extends Component
{
    use WithPagination;

    public $user_id; 

    public function mount($user_id)
    {
        $this->user_id = $user_id;
    }

    public function render()
    {
        $attendances = Attendance::where('user_id', $this->user_id)->orderBy('date', 'desc')->paginate(20);
        return view('livewire.attendance.detail', compact('attendances'));
    }
}
