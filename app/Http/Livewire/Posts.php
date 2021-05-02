<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['echo:posts,PostAdded' => "postAdded", 'echo:posts,PostLiked' => 'likedPost'];

    public function postAdded($id)
    {

        Post::latest()->paginate(10)->prepend(Post::find($id));
        session()->flash('status', "Post created");

    }


    public function render()
    {

        $posts = Post::latest()->paginate(10);
        return view('livewire.posts', compact('posts'));
    }
}
