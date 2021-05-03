@extends('layoutlanding')
@section('title', 'SIMP - Register')


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

    <form action="{{ url('/register') }}" method="post" class="form-signin card mt-4">
        @csrf
        <div class="form-group">
            <label class="sr-only" for="username">Username</label>
            <input value="{{ old('username') }}" class="form-control" id="username" placeholder="Username" name="username"
                autocomplete="username" required>
            <label class="sr-only" for="nama">Nama lengkap</label>
            <input value="{{ old('nama') }}" class="form-control" id="nama" placeholder="Nama lengkap" name="nama"
                autocomplete="name" required>
            <label class="sr-only" for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
            <label class="sr-only" for="cpassword">Konfirmasi Password</label>
            <input type="password" class="form-control" id="cpassword" placeholder="Konfirmasi password" name="cpassword"
                required>
            <button type="submit" class="btn btn-block btn-primary mt-4">Register</button>
            <a href="{{ url('/login') }}" class="btn btn-block btn-outline-primary">Log in</a>
        </div>
    </form>

@endsection
