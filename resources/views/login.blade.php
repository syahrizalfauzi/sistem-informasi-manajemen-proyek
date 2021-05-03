@extends('layoutlanding')
@section('title', 'SIMP - Log in')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p class="text-left mb-0">
                    {{ $error }}
                </p>
            @endforeach
        </div>
    @endif

    <form action="{{ url('/login') }}" method="post" class="form-signin card mt-4">
        @csrf
        <div class="form-group">
            <label for="username" class="sr-only">Username</label>
            <input class="form-control" id="username" placeholder="Username" name="username" autocomplete="username"
                required autofocus>
            <label for="password" class="sr-only">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required
                autocomplete="current-password">
        </div>
        <button type="submit" class="btn btn-block btn-primary mb-2">Log in</button>
        <a href="{{ url('/register') }}">Belum punya akun? daftar dulu</a>
    </form>
    @if (session('message'))
        <div class="alert alert-success mt-4">
            {{ session('message') }}
        </div>
    @endif
@endsection
