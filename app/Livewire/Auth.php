<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth as Login;
use Illuminate\Validation\ValidationException;

class Auth extends Component
{
    #[Rule('required', message: 'User/Nip Tidak Boleh Kosong')]
    public $nip;

    #[Rule('required', message: 'kata sandi tidak boleh kosong')]
    public $password;

    // #[Rule('required', message: 'Masukkan Isi Post')]
    // #[Rule('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $remember_me = true;

    public function store()
    {

        $this->validate();
        $credentials = [
            'nip' => $this->nip,
            'password' => $this->password,
        ];
        $user = User::where('nip', $this->nip)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'nip' => 'User/Nip Tidak Terdaftar.',
            ]);
        }

        if (Login::attempt($credentials, $this->remember_me)) {
            $redirectRoute = $user->is_admin ? 'home.index' : 'home.index';
            session()->flash('success', 'Login berhasil!');
            return redirect()->route($redirectRoute);
        }else{
            throw ValidationException::withMessages([
                'password' => 'Kata Sandi Anda Salah.',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth')->layout('layouts.login');
    }
}
