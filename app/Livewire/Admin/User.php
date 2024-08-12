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
    public $selectedUser;
    public $statusLeave;
    public $startDate;
    public $endDate;

    public function statusUser($id)
    {
        $user = ModelsUser::find($id);
        $user->status = !$user->status;
        $user->save();
        request()->session()->flash('success', 'Status User ' . $user->name . ' Sudah Di Ubah ');
    }

    public function applyFilter() {}

    public function selectUser($userId)
    {
        $this->selectedUser = ModelsUser::find($userId);
        // Bisa juga di sini Anda set nilai-nilai awal yang mungkin diperlukan.
        $this->dispatch('openModal');
    }

    public function leave()
    {
        dd($this->statusLeave, $this->startDate, $this->endDate);
    }

    public function resetPassword($id)
    {
        $user = ModelsUser::find($id);
        $user->password = $user->nip;
        // $user->password = '123';
        $user->save();
        request()->session()->flash('success', 'Reset ' . $user->name .  ' Password Berhasil');
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
