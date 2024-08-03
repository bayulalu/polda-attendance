<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class AddSetting extends Component
{
    public $day;
    public $time_arrival;
    public $time_gohome;


    public function store()
    {
        $validate = $this->validate([
            'day' => 'required|unique:settings',
            'time_arrival' => 'required',
            'time_gohome' => 'required',
        ]);

        Setting::create([
            'day' => $this->day,
            'time_arrival' => $this->time_arrival,
            'time_gohome' => $this->time_gohome
        ]);

        $this->reset(['day', 'time_arrival', 'time_gohome']);
        request()->session()->flash('success', 'Data Berhasil Disimpan');
    }


    public function render()
    {
        return view('livewire.admin.add-setting');
    }
}
