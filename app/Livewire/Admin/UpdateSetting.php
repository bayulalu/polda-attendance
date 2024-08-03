<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class UpdateSetting extends Component
{

    public $id;
    public $day;
    public $time_arrival;
    public $time_gohome;


    public function mount($id)
    {
        $setting = Setting::find($this->id);
        $this->id = $id;
        $this->day = $setting->day;
        $this->time_arrival = $setting->time_arrival;
        $this->time_gohome = $setting->time_gohome;
    }

    public function update()
    {
        $validate = $this->validate([
            'time_arrival' => 'required',
            'time_gohome' => 'required',
        ]);

        $setting = Setting::find($this->id);
        $setting->update([
            'time_arrival' => $this->time_arrival,
            'time_gohome' => $this->time_gohome
        ]);

        return redirect()->route('admin.setting');
    }



    public function render()
    {
        return view('livewire.admin.update-setting');
    }
}
