@extends('layout')
@section('title', 'SIMP - Gabung')
@section('nama', $nama)
@section('navlink', 'join')

@section('content')
    <h1>Bergabung ke proyek lain</h1>
    <p>Silahkan masukkan kode proyek untuk bergabung</p>
    <form action="{{ url('/projects/join') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="kode">Kode proyek</label>
            <input class="form-control mb-2" value="{{ old('kode') }}" id="kode" placeholder="1234abcd" name="kode"
                required autofocus>
            <input type="submit" value="Cari" class="btn btn-block btn-primary">
        </div>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p class="text-left mb-0">
                    {{ $error }}
                </p>
            @endforeach
        </div>
    @endif
@endsection
