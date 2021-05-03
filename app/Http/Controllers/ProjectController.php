<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Utils\RandomStringGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects =  Auth::user()->projects;
        $nama = Auth::user()->nama;
        return view('projects.index', compact('projects', 'nama'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nama = Auth::user()->nama;
        return view('projects.create', compact('nama'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
        ]);
        $judul = $request->judul;
        $deskripsi = $request->deskripsi;

        $generator = new RandomStringGenerator;
        do {
            $id = $generator->generate(8);
        } while (Project::find($id));

        $project = new Project([
            'id' => $id,
            'judul' => $judul,
            'deskripsi' => $deskripsi
        ]);
        $project->save();
        $project->users()->attach(Auth::user()->id);
        return redirect('/');
    }
    /**
     * Show the form for join a new project.
     *
     * @return \Illuminate\Http\Response
     */
    public function join()
    {
        //
    }

    /**
     * Join a project.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeJoin(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $nama = Auth::user()->nama;
        return view('projects.show', [
            'project' => $project,
            'nama' => $nama
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}