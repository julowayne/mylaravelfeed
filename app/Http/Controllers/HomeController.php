<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'posts' => Post::get()
        ]);
    }

    public function createPost(Request $request)
    {
        $request->validate(['body' => 'required|min:6']);

        auth()->user()->posts()->create(['body' => $request->body]);

        return redirect(route('home'));
    }

    public function user()
    {
        return view('livewire.user');
    }

    public function updateUserName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20'
        ]);
        if($validator->fails()){
            return redirect(route('user'))
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::where('id', Auth::id())->first();
        $user->name = $request->input('name');
        $user->save();
        $request->session()->flash('message', 'Votre nom a bien été modifié');
        return redirect(route('user'));
    }

    public function updateUserEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:50'
        ]);
        if($validator->fails()){
            return redirect(route('user'))
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::where('id', Auth::id())->first();
        $user->email = $request->input('email');
        $user->save();
        $request->session()->flash('message', 'Votre Email a bien été modifié');
        return redirect(route('user'));
    }

    public function updateUserPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|max:16'
        ]);
        if($validator->fails()){
            return redirect(route('user'))
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::where('id', Auth::id())->first();
        Hash::make($user->password = $request->input('password'));
        $user->save();
        $request->session()->flash('message', 'Votre mot de passe a bien été modifié');
        return redirect(route('user'));
    }

    public function updateUserAvatar(Request $request)
    {
        // dd($request->file('avatar'));
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $user = User::where('id', Auth::id())->first();
            $user->avatar = $name;
            $user->save();
            $request->session()->flash('message', 'Votre image a bien été modifié');
            return redirect(route('user'));    
        }
    }
}
