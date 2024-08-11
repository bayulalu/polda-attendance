<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UpdateUser extends Component
{

    public $id;
    public $nip;
    public $name;
    public $rank;
    public $gender;
    public $position;

    public function update()
    {
        $validate = $this->validate([
            'nip' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'position' => 'required',
            'rank' => 'required'
        ]);

        $user = User::find($this->id);
        $user->update([
            'nip' => $this->nip,
            'name' => $this->name,
            'gender' => $this->gender,
            'position' => $this->position,
            'rank' => $this->rank
        ]);
        request()->session()->flash('success', 'Berhasil Update User ' . $user->name);
        return redirect()->route('admin.akun');
    }


    public function mount($id)
    {
        $user = User::find($this->id);


        $this->id   = $user->id;
        $this->nip    = $user->nip;
        $this->name  = $user->name;
        $this->gender  = $user->gender;
        $this->position  = $user->position;
        $this->rank  = $user->rank;

    }


    public function render()
    {

        return view('livewire.admin.update-user');
    }
}
