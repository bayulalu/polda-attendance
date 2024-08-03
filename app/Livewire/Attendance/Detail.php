<?php

namespace App\Livewire\Attendance;

use App\Models\Attemdance;
use Livewire\Component;

class Detail extends Component
{
    public $user_id; 

    public function mount($user_id)
    {
        $this->user_id = $user_id;
    }


    public function render()
    {
        $attendances = Attemdance::where('user_id', $this->user_id)->paginate(40);
        return view('livewire.attendance.detail', compact('attendances'));
    }
}
