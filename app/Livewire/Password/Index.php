<?php

namespace App\Livewire\Password;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $oldPassword;
    public $newPassword;

    public function store()
    {
        // Validasi input
        $this->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
        ],
        [
            'oldPassword.required' => 'Kata Sandi Lama Tidak Boleh Kosong',
            'newPassword.required' => 'Kata Sandi Baru Tidak Boleh Kosong',
            'newPassword.min' => 'Kata Sandi Baru harus minimal 6 karakter',
        ]
    );

        // Memverifikasi password lama
        if (!Hash::check($this->oldPassword, Auth::user()->password)) {
            session()->flash('error', 'Kata Sandi lama tidak sesuai.');
            return;
        }

        // Mengubah password baru
        Auth::user()->update([
            'password' => Hash::make($this->newPassword),
        ]);
        $this->reset(['oldPassword',  'newPassword']);

        session()->flash('success', 'Kata Sandi berhasil diubah.');
    }

    public function render()
    {
        return view('livewire.password.index');
    }
}
