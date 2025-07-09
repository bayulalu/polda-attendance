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


    public function store()
    {
        $validate = $this->validate(
            [
                'nip' => 'required|unique:users',
                'name' => 'required',
                'position' => 'required',
            ],
            [
                'nip' => 'Data Nip Tidak Boleh Kosong',
                'name' => 'Data Nama Tidak Boleh Kosong',
                'position' => 'Data Jabatan Tidak Boleh Kosong'
            ]
        );

        User::create([
            'nip' => $this->nip,
            'name' => $this->name,
            'position' => $this->position,
            'password' => $this->nip,
            'is_admin' => false,
            'status' => true
        ]);

        $this->reset(['nip',  'name', 'gender', 'position']);
        request()->session()->flash('success', 'Data Berhasil Disimpan');
    }

    public function render()
    {
        return view('livewire.admin.add-user');
    }
}
