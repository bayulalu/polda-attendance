<?php

namespace App\Livewire\Admin;

use App\Models\User as ModelsUser;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination;

    public function render()
    {
        $users = ModelsUser::latest()->paginate(20);

        return view('livewire.admin.user', compact('users'));
    }
}
