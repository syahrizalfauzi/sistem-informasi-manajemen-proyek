@extends('layout')
@section('title', 'SIMP - ' . $project->judul)
@section('nama', $nama)
@section('navlink', 'tasks.show')

@section('content')
    <a href="{{ url('projects/' . $project->id) }}" class="text-primary">Kembali</a>
    <h1>{{ $task->judul }}</h1>
    <p>{{ $task->deskripsi }}</p>
    <span>
        Status :
        @if ($task->status == 0)
            <b class="text-warning">Belum selesai</b>
        @else
            <b class="text-success">Sudah selesai</b>
        @endif
    </span>
    <div class="d-flex flex-row float-right">
        <a href="{{ url('projects/' . $project->id . '/tasks/edit/' . $task->id) }}" class="btn btn-info mr-2">Ubah</a>
        <form action="{{ url('projects/' . $project->id . 'task/' . $task->id) }}" method="POST">
            @method('DELETE')
            <input type="submit" value="Hapus" class="btn btn-danger">
        </form>
    </div>
@endsection
