<?php

namespace App\Livewire\Absensi;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListAbsen extends Component
{

    public $startDate;
    public $endDate;

    
    public function mount()
    {
        Carbon::setLocale('id');
        $this->startDate = Carbon::now()->subDays(7); // Tanggal 7 hari yang lalu
        $this->endDate = Carbon::now(); // Tanggal hari ini
    }


    public function render()
    {
        Carbon::setLocale('id');
      
        $attendances = Attendance::where('user_id', Auth::user()->id)
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->orderBy('date', 'desc')
            ->paginate(20);
        return view('livewire.absensi.list-absen', compact('attendances'));
    }
}
