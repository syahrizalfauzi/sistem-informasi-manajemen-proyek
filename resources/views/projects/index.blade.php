@extends('layout')
@section('title', 'SIMP - Dashboard')
@section('nama', $nama)

@section('content')

    @if ($projects->count() > 0)
        <div class="d-flex mb-2 justify-content-between">
            <h4>Daftar Proyek</h4>
            <a href="{{ url('/projects/create') }}" class="btn btn-primary">Buat proyek</a>
        </div>
        @foreach ($projects as $project)
            <a href='{{ url('/projects/' . $project->id) }}' class="card p-3 mb-2">
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
        <p class="d-flex align-items-stretch justify-content-center">Anda belum memiliki proyek</p>
    @endif
@endsection
