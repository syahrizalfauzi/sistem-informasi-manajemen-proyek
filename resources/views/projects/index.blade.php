@extends('layout')
@section('title', 'SIMP - Dashboard')
@section('nama', $nama)

@section('content')

    @if ($projects->count() > 0)
        <div class="d-flex mb-2 justify-content-between">
            <h4>Daftar Proyek</h4>
            <div>
                <a href="{{ url('/projects/join') }}" class="btn btn-outline-primary">Gabung</a>
                <a href="{{ url('/projects/create') }}" class="btn btn-primary">Buat proyek</a>
            </div>
        </div>
        @if (session('message'))
            <div class="alert alert-success mt-4">
                {{ session('message') }}
            </div>
        @endif
        @foreach ($projects as $project)
            <a href='{{ url('/projects/' . $project->id) }}' class="card p-3 mb-2">
                <h3>{{ $project->judul }}</h3>
                @if ($project->users[0]->id != $userId)
                    <b>Milik {{ $project->users[0]->nama }}</b>
                @endif
                <p>{{ $project->deskripsi }}</p>
                @if ($project->users->count() > 1)
                    <p class="text-muted">Jumlah anggota : {{ $project->users->count() }}</p>
                @endif
                @if ($project->tasks->count() > 0)
                    <p class="text-muted">Tugas : {{ $project->tasks->where('status', true)->count() }} /
                        {{ $project->tasks->count() }}
                    </p>
                @else
                    <p class="text-muted">Belum ada tugas</p>
                @endif
            </a>
        @endforeach
    @else
        <div class="d-flex h-100 flex-column align-items-center justify-content-center">
            <p>Anda belum memiliki proyek</p>
            <p>Silahkan buat proyek baru atau bergabung dengan proyek pengguna lain</p>
            <div class="mt-2">
                <a href="{{ url('/projects/join') }}" class="btn btn-outline-primary">Gabung</a>
                <a href="{{ url('/projects/create') }}" class="btn btn-primary">Buat</a>
            </div>
        </div>
    @endif
@endsection
