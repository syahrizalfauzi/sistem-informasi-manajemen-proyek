@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ url('/login') }}" method="post">
    @csrf
    <h1>Log in</h1>
    <div class="form-group">
        <label for="username">Username</label>
        <input class="form-control" id="username" placeholder="Username" name="username" autocomplete="username">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password" name="password"
            autocomplete="current-password">
    </div>
    <button type="submit" class="btn btn-block btn-primary">Log in</button>
</form>

<a href="{{ url('/register') }}">Belum punya akun? daftar dulu yuk!</a>
