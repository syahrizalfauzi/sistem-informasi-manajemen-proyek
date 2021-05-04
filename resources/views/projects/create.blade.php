@extends('layout')
@section('title', 'SIMP - Proyek baru')
@section('nama', $nama)
@section('navlink', 'create')

@section('content')
    <h1>Buat proyek baru</h1>
    <p>Silahkan isi form di bawah untuk membuat proyek baru</p>
    <form action="{{ url('/projects') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="judul">Judul proyek</label>
            <input class="form-control mb-2" id="judul" placeholder="Tugas besar praktikum" name="judul" required autofocus
                maxlength="255">
            <label for="deskripsi">Deskripsi (opsional)</label>
            <textarea class="form-control mb-2" id="deskripsi" placeholder="Proyek besar kelompok saya" maxlength="255"
                name="deskripsi"></textarea>
            <input type="submit" value="Simpan" class="btn btn-block btn-primary">
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
