<?php

namespace App\Http\Livewire;

use App\Events\PostAdded;
use Livewire\Component;

class Form extends Component
{
    public $body;

    public function createPost()
    {
        $this->validate(['body' => 'required|min:15']);

        $post = auth()->user()->posts()->create(['body' => $this->body]);

        $this->emit('postAdded', $post->id);
        
        broadcast(new PostAdded($post));

        $this->body = "";
    }

    public function render()
    {
        return view('livewire.form');
    }
}
