<?php

namespace App\Livewire\Absensi;

use App\Models\Attemdance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListAbsen extends Component
{
    public function render()
    {
        Carbon::setLocale('id');
        $attendances = Attemdance::where('user_id', Auth::user()->id)->latest()->paginate(20);
        return view('livewire.absensi.list-absen', compact('attendances'));
    }
}
