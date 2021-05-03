@extends('layout')
@section('title', 'SIMP - Dashboard')

@section('content')
    <h2>Selamat datang</h2>
    <h1>{{ $nama }}!</h1>

    @if ($projects->count() > 0)
        <h4>Daftar proyek</h4>

        @foreach ($projects as $project)
            <a href='{{ url('/projects/' . $project->id) }}' class="card p-3">
                <h3>{{ $project->judul }}</h3>
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
        <p>Anda belum memiliki proyek</p>
    @endif
@endsection
