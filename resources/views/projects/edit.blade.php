@extends('layout')
@section('title', 'SIMP - Ubah proyek')
@section('nama', $nama)
@section('navlink', 'edit')

@section('content')
    <h1>Ubah proyek</h1>
    <p>Perubahan data proyek</p>
    <form action="{{ url('/projects/' . $project->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="judul">Judul proyek</label>
            <input value="{{ $project->judul }}" class="form-control mb-2" id="judul" placeholder="Tugas besar praktikum"
                name="judul" required autofocus maxlength="255">
            <label for="deskripsi">Deskripsi (opsional)</label>
            <textarea class="form-control mb-2" id="deskripsi" placeholder="Proyek besar kelompok saya" maxlength="255"
                name="deskripsi">{{ $project->deskripsi }}</textarea>
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
