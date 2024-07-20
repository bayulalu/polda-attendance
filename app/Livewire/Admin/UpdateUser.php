<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UpdateUser extends Component
{

    public $id;
    public $nip;
    public $name;
    public $email;
    public $gender;
    public $position;

    public function update()
    {
        $validate = $this->validate([
            'nip' => 'required',
            'email' => 'required|email',
            'name' => 'required',
            'gender' => 'required',
            'position' => 'required',
        ]);

        $user = User::find($this->id);
        $user->update([
            'nip' => $this->nip,
            'email' => $this->email,
            'name' => $this->name,
            'gender' => $this->gender,
            'position' => $this->position
        ]);

        return redirect()->route('admin.akun');
    }


    public function mount($id)
    {
        $user = User::find($this->id);


        $this->id   = $user->id;
        $this->nip    = $user->nip;
        $this->name  = $user->name;
        $this->email  = $user->email;
        $this->gender  = $user->gender;
        $this->position  = $user->position;
    }


    public function render()
    {

        return view('livewire.admin.update-user');
    }
}
