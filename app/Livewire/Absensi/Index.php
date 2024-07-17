<?php

namespace App\Livewire\Absensi;

use Livewire\Component;

class Index extends Component
{

    public function savePhoto($dataUrl)
    {
        // Decode data URL
        // $data = explode(',', $dataUrl);
        // $data = base64_decode($data[1]);
        // dd($data);
        // Simpan gambar ke storage
        // $fileName = 'photo_' . time() . '.png';
        // $fileName = 'photo_1'. '.png';
        // $php
        // dd($dataUrl);
        // Storage::disk('public')->put($fileName, $data);

        session()->flash('message', 'Photo saved successfully!');
        $this->emit('photoSaved');
    }

    public function render()
    {
        return view('livewire.absensi.index');
    }
}
