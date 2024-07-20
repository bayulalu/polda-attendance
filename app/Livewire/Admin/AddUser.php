<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
class AddUser extends Component
{
    public $nip;
    public $name;
    public $email;
    public $gender;
    public $position;


    public function store()
    {
        $validate = $this->validate([
            'nip' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'gender' => 'required',
            'position' => 'required',
        ]);

        User::create([
            'nip' => $this->nip,
            'email' => $this->email,
            'name' => $this->name,
            'gender' => $this->gender,
            'position' => $this->position,
            'password' => Str::random(10),
            'is_admin' => false,
            'status' => true
        ]);

        $this->reset(['nip', 'email', 'name', 'gender', 'position']);
        request()->session()->flash('success', 'Data Berhasil Disimpan');


    }

    public function render()
    {
        return view('livewire.admin.add-user');
    }
}
