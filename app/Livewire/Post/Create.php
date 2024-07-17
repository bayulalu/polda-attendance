<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;

class Create extends Component
{
    use WithFileUploads;

    public $errorMessage;
    
    #[Rule('required', message: 'Masukkan Gambar Post')]
    #[Rule('image', message: 'File Harus Gambar')]
    #[Rule('max:6024', message: 'Ukuran File Maksimal 1MB')]
    public $image;

    #[Rule('required', message: 'Masukkan Judul Post')]
    public $title;

    #[Rule('required', message: 'Masukkan Isi Post')]
    #[Rule('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $content;
    

    public function store()
    {
        $this->validate();
        if (true) {
            $this->errorMessage = "error";
            return;
        }

        //store image in storage/app/public/posts
        $this->image->storeAs('public/posts', $this->image->hashName());

        //create post
        Post::create([
            'image' => $this->image->hashName(),
            'title' => $this->title,
            'content' => $this->content,
        ]);

        //flash message
        session()->flash('message', 'Data Berhasil Disimpan.');

        //redirect
        return redirect()->route('posts.index');
    }


    public function render()
    {
        return view('livewire.post.create')->layout('layouts.app2');
    }
}
