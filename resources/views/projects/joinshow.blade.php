@extends('layout')
@section('title', 'SIMP - Gabung')
@section('nama', $nama)
@section('navlinks')

@section('content')
    <h1>Bergabung ke proyek lain</h1>
    <p>Silahkan masukkan kode proyek untuk bergabung</p>
    <form action="{{ url('/projects/join') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="kode">Kode proyek</label>
            <input maxlength="8" class="form-control mb-2" id="kode" placeholder="1234abcd" name="kode" required autofocus>
            <input type="submit" value="Cari" class="btn btn-block btn-primary">
        </div>
    </form>
    <p>Proyek dengan kode {{ $project->id }}</p>
    <div class="d-flex flex-row justify-content-between align-items-center">
        <h1>{{ $project->judul }}</h1>
        @if ($isJoined)
            <div>
                <p class="btn btn-outline-success disabled">Sudah bergabung</p>
                <a href="{{ url('/projects/' . $project->id) }}" class="btn btn-primary">Lihat proyek</a>
            </div>
        @else
            <form action="{{ url('/projects/join/store') }}" method="POST">
                @csrf
                <input type="hidden" name="kode" value="{{ $project->id }}">
                <input type="submit" value="Gabung" class="btn btn-primary">
            </form>
        @endif
    </div>
    @if ($project->users[0]->id == $userId)
        <b>Milik sendiri</b>
    @else
        <b>Milik {{ $project->users[0]->nama }}</b>
    @endif
    @if ($project->deskripsi)
        <p>{{ $project->deskripsi }}</p>
    @else
        <p>Tidak ada deskripsi</p>
    @endif
    <p>Jumlah anggota : {{ $project->users->count() }}</p>
@endsection
