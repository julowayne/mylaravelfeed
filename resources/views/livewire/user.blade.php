@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header shadow-sm">{{ __('Mon profil') }}</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('changeUsername') }}">
                        @csrf
                            <div class="form-group">
                            @error('body')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            @if(Session::has('message'))
                                <p class="alert alert-info">{{ Session::get('message') }}</p>
                            @endif
                                <label for="name">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                <button type="submit" class="btn btn-primary mt-3">Modifier</button>
                            </div>
                        </form>
                        <form method="post" action="{{ route('changeUserEmail') }}">
                        @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                <button type="submit" class="btn btn-primary mt-3">Modifier</button>
                            </div>
                        </form>
                        <form method="post" action="{{ route('changeUserPassword') }}">
                        @csrf
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                                <button type="submit" class="btn btn-primary mt-3">Modifier</button>
                            </div>
                        </form>
                        <form method="post" action="{{ route('changeUserAvatar') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="avatar" id="inputGroupFile04">
                                    <label class="custom-file-label" for="avatar">Choisir mon fichier</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Modifier</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
