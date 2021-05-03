@extends('layout')
@section('title', 'SIMP - Proyek baru')
@section('nama', $nama)

@section('content')
    <h1>Buat proyek baru</h1>
    <form action="{{ url('/projects') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="judul">Judul proyek</label>
            <input class="form-control mb-2" id="judul" placeholder="Tugas besar praktikum" name="judul" required autofocus>
            <label for="deskripsi">Deskripsi (opsional)</label>
            <textarea class="form-control mb-2" id="deskripsi" placeholder="Proyek besar kelompok saya"
                name="deskripsi"></textarea>
            <input type="submit" value="Simpan" class="btn btn-block btn-primary">
        </div>
    </form>
@endsection
