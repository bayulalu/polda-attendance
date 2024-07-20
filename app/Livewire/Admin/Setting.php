<?php

namespace App\Livewire\Admin;

use App\Models\Setting as ModelSetting;
use Livewire\Component;

class Setting extends Component
{
    public function render()
    {
        $settings = ModelSetting::get();
        return view('livewire.admin.setting', compact('settings'));
    }
}
