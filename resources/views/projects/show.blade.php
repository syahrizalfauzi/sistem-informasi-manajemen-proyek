@extends('layout')
@section('title', 'SIMP - ' . $project->judul)
@section('nama', $nama)
@section('navlink', 'show')

@section('content')
    <div class="jumbotron">
        @if ($project->users[0]->id == $userId)
            <div class="float-right d-flex flex-row">
                <form action="{{ url('/projects/' . $project->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Hapus" class="btn btn-danger">
                </form>
                <a href="{{ url('/projects/edit/' . $project->id) }}" class="btn btn-info ml-2">Ubah</a>
            </div>
        @endif
        <h1>{{ $project->judul }}</h1>
        <p class="text-muted">Kode : {{ $project->id }}</p>
        <p>{{ $project->deskripsi }}</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 mb-4">
                <h4>Anggota ({{ $project->users->count() }})</h4>
                @foreach ($project->users as $user)
                    <p class="card p-1">{{ $user->nama }}</p>
                @endforeach
            </div>
            <div class="col-sm-8">
                <div class="d-flex justify-content-between">
                    <h4>Tugas</h4>
                    <a href="{{ url('projects/' . $project->id . '/tasks/create') }}" class="btn btn-primary">
                        Tambah tugas
                    </a>
                </div>
                @if ($project->tasks->count() > 0)
                    <p class="mb-2">Total ada {{ $project->tasks->count() }} tugas</p>
                @else
                    <p class="mb-2">Belum ada tugas</p>
                @endif
                @foreach ($project->tasks as $task)
                    <div class="card p-1 mb-2 d-flex flex-row justify-content-between align-items-center">
                        <div>
                            <p>{{ $task->judul }}</p>
                            <p class="text-muted">{{ $task->deskripsi }}</p>
                        </div>
                        <p>{{ $task->status }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
