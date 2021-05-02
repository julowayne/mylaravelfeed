<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Like;

class Post extends Component
{
    public $post;
    public $isliked;
    public $howManyLiked;


    public function mount($post)
    {
        $this->post = $post;
        $this->isliked = Like::where('user_id', auth()->user()->getAuthIdentifier())->where('post_id', $post->id)->first();
        $this->howManyLiked[$post->id] = count(Like::where('post_id', $post->id)->get());
    }

    public function render()
    {
        return view('livewire.post');
    }

    public function postLiked()
    {
        $userId = auth()->user()->id;
        $postId = $this->post->id;
        $post = auth()->user()->like()->create(['user_id' => $userId, 'post_id' => $postId]);
        $this->isliked = true;
        $this->emit('likedPost', $post->post_id);
    }
}
