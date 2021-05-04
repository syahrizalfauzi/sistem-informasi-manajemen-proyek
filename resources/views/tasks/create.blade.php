@extends('layout')
@section('title', 'SIMP - Tugas baru')
@section('nama', $nama)
@section('navlink', 'tasks.create')

@section('content')
    <a href="{{ url('projects/' . $project->id) }}" class="text-primary">Kembali</a>
    <h1>Buat tugas baru</h1>
    <p>Silahkan isi form di bawah untuk menambahkan tugas untuk proyek '{{ $project->judul }}'</p>
    <form action="{{ url('/projects/' . $project->id . '/tasks') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="judul">Judul tugas</label>
            <input class="form-control mb-2" id="judul" placeholder="Buat laporan modul 1" name="judul" required autofocus
                maxlength="255">
            <label for="deskripsi">Deskripsi (opsional)</label>
            <textarea class="form-control mb-2" id="deskripsi" placeholder="Format laporan bisa diambil dari classroom"
                maxlength="255" name="deskripsi"></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status tugas</label>
            <select name="status" id="status" class="btn btn-outline-secondary">
                <option value="0">Belum selesai</option>
                <option value="1">Sudah selesai</option>
            </select>
        </div>
        <input type="submit" value="Simpan" class="btn btn-block btn-primary">
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
