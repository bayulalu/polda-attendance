<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;

class AddUser extends Component
{
    public $nip;
    public $name;
    public $gender;
    public $position;
    public $rank;


    public function store()
    {
        $validate = $this->validate([
            'nip' => 'required|unique:users',
            'name' => 'required',
            'gender' => 'required',
            'position' => 'required',
            'rank' => 'required'
        ]);

        User::create([
            'nip' => $this->nip,
            'name' => $this->name,
            'gender' => $this->gender,
            'position' => $this->position,
            'password' => $this->nip,
            'is_admin' => false,
            'status' => true,
            'rank' => $this->rank
        ]);

        $this->reset(['nip',  'name', 'gender', 'position', 'rank']);
        request()->session()->flash('success', 'Data Berhasil Disimpan');
    }

    public function render()
    {
        return view('livewire.admin.add-user');
    }
}
