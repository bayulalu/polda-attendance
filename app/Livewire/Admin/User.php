<?php

namespace App\Livewire\Admin;

use App\Models\User as ModelsUser;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class User extends Component
{
    use WithPagination;

    public function statusUser($id)
    {
        $user = ModelsUser::find($id);
        $user->status = !$user->status;
        $user->save();
    }

    public function resetPassword($id)
    {
        $user = ModelsUser::find($id);
        // $user->password = Str::random(10);
        $user->password = '123';
        $user->save();
    }

    public function render()
    {
        $users = ModelsUser::latest()->paginate(20);

        return view('livewire.admin.user', compact('users'));
    }
}
