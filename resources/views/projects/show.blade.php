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
            <div class="col-md-4 mb-4">
                <h4>Anggota ({{ $users->count() }})</h4>
                @foreach ($users as $user)
                    <p class="card p-1">{{ $user->nama }}</p>
                @endforeach
                <div class="float-right">
                    {{ $users->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <div class="col-md-8">
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
                @foreach ($tasks as $task)
                    <div class="card p-2 mb-2">
                        <a href="{{ url('projects/' . $project->id . '/tasks/' . $task->id) }}">
                            <p>{{ $task->judul }}</p>
                            <p class="text-muted">{{ $task->deskripsi }}</p>
                        </a>
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            @if ($task->status == 0)
                                <p class="text-warning">Belum selesai</p>
                            @else
                                <p class="text-success">Sudah selesai</p>
                            @endif
                            <div class="btn-group ml-4 dropleft">
                                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Opsi
                                </button>
                                <div class="dropdown-menu">
                                    <form action="{{ url('projects/' . $project->id . '/task/' . $task->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="judul" value="{{ $task->judul }}">
                                        <input type="hidden" name="deskripsi" value="{{ $task->deskripsi }}">
                                        <input type="hidden" name="from" value="project">
                                        @if ($task->status == 0)
                                            <input type="hidden" name="status" value="1">
                                            <input type="submit" value="Tandai sudah selesai" class="dropdown-item">
                                        @else
                                            <input type="hidden" name="status" value="0">
                                            <input type="submit" value="Tandai belum selesai" class="dropdown-item">
                                        @endif
                                    </form>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-info"
                                        href="{{ url('projects/' . $project->id . '/tasks/edit/' . $task->id) }}">Ubah</a>
                                    <form action="{{ url('projects/' . $project->id . '/task/' . $task->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Hapus" class="dropdown-item text-danger">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="float-right">
                    {{ $tasks->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
