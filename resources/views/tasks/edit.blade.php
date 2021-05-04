@extends('layout')
@section('title', 'SIMP - Ubah tugas')
@section('nama', $nama)
@section('navlink', 'tasks.edit')

@section('content')
    <a href="{{ url('projects/' . $project->id) }}" class="text-primary">Kembali</a>
    <h1>Ubah tugas</h1>
    <p>Perubahan data tugas untuk proyek '{{ $project->judul }}'</p>
    <form action="{{ url('/projects/' . $project->id . '/task/' . $task->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="judul">Judul tugas</label>
            <input class="form-control mb-2" id="judul" placeholder="Buat laporan modul 1" name="judul" required autofocus
                maxlength="255" value="{{ $task->judul }}">
            <label for="deskripsi">Deskripsi (opsional)</label>
            <textarea class="form-control mb-2" id="deskripsi" placeholder="Format laporan bisa diambil dari classroom"
                maxlength="255" name="deskripsi">{{ $task->deskripsi }}</textarea>
        </div>
        <div class="form-group">
            <label for="status">Status tugas</label>
            <select name="status" id="status" class="btn btn-outline-secondary">
                <option value="0" @if ($task->status == 0) selected @endif>
                    Belum selesai</option>
                <option value="1" @if ($task->status == 1) selected @endif>
                    Sudah selesai</option>
            </select>
        </div>
        <input type="hidden" name="from" value="task">
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
