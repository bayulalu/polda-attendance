<?php

namespace App\Livewire\Admin;

use App\Models\User as ModelsUser;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class User extends Component
{
    use WithPagination;
    public $searchName;
    
    public function statusUser($id)
    {
        $user = ModelsUser::find($id);
        $user->status = !$user->status;
        $user->save();
    }

    public function applyFilter()
    {
       
    }

    public function resetPassword($id)
    {
        $user = ModelsUser::find($id);
        $user->password = $user->nip;
        // $user->password = '123';
        $user->save();
    }

    public function render()
    {
      $query = ModelsUser::query();

    if ($this->searchName) {
        $query->where('name', 'like', '%' . $this->searchName . '%');
    }

    $users = $query->latest()->paginate(20);

        return view('livewire.admin.user', compact('users'));
    }
}
