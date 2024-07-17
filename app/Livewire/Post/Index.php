<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;


    public function destroy($id)
    {
        //destroy
        Post::destroy($id);

        //flash message
        session()->flash('message', 'Data Berhasil Dihapus.');

        //redirect
        return redirect()->route('posts.index');
    }

    public function render()
    {
        return view('livewire.post.index', [
            'posts' => Post::latest()->paginate(5)
        ]);
    }
}
