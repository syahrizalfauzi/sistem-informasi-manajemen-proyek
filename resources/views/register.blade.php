@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ url('/register') }}" method="post">
    @csrf
    <h1>Register</h1>
    <div class="form-group">
        <label for="username">Username</label>
        <input class="form-control" id="username" placeholder="Username" name="username" autocomplete="username">
    </div>
    <div class="form-group">
        <label for="nama">Nama lengkap</label>
        <input class="form-control" id="nama" placeholder="Nama lengkap" name="nama" autocomplete="name">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
    </div>
    <div class="form-group">
        <label for="cpassword">Konfirmasi Password</label>
        <input type="password" class="form-control" id="cpassword" placeholder="Confirm password" name="cpassword">
    </div>
    <button type="submit" class="btn btn-block btn-primary">Register</button>
</form>
