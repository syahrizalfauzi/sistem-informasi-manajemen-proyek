<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Utils\RandomStringGenerator;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects =  Auth::user()->projects->paginate(5);
        // $projects = Project::paginate(5);
        $nama = Auth::user()->nama;
        $userId = Auth::user()->id;
        return view('projects.index', compact('projects', 'nama', 'userId'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nama = Auth::user()->nama;
        return view('projects.create', compact('nama'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'max:255'
        ]);

        $generator = new RandomStringGenerator;
        do {
            $id = $generator->generate(8);
        } while (Project::find($id));

        $project = new Project();
        $project->id = $id;
        $project->judul = $request->judul;
        $project->deskripsi = $request->deskripsi;
        $project->save();
        $project->users()->attach(Auth::user()->id);
        return redirect('/');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function join()
    {
        $nama = Auth::user()->nama;
        return view('projects.join', compact('nama'));
    }

    /**
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function showJoin(Project $project)
    {
        $isJoined = $project->users->contains('id', Auth::user()->id);
        $nama = Auth::user()->nama;
        $userId = Auth::user()->id;
        return view('projects.joinshow', [
            'project' => $project,
            'isJoined' => $isJoined,
            'nama' => $nama,
            'userId' => $userId
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeShowJoin(Request $request)
    {
        $request->validate([
            'kode' => 'required'
        ]);

        $kode = $request->kode;
        if (Project::find($kode))
            return redirect('/projects/join/' . $kode);

        return back()->withErrors(['error' => 'Proyek tidak ditemukan']);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeJoin(Request $request)
    {
        $kode = $request->kode;
        $project = Project::find($kode);
        $project->users()->attach(Auth::user()->id);
        return redirect('/projects/' . $project->id);
    }

    /**
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $users = $project->users->paginate(20, null, null, 'users');
        $tasks = $project->tasks->paginate(5, null, null, 'tasks');
        $nama = Auth::user()->nama;
        $userId = Auth::user()->id;
        return view('projects.show', [
            'users' => $users,
            'tasks' => $tasks,
            'project' => $project,
            'nama' => $nama,
            'userId' => $userId
        ]);
    }

    /**
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $nama = Auth::user()->nama;
        return view('projects.edit', [
            'project' => $project,
            'nama' => $nama
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'max:255'
        ]);

        $project->judul = $request->judul;
        $project->deskripsi = $request->deskripsi;

        $project->update();
        return redirect('/projects/' . $project->id);
    }

    /**
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->users()->detach();
        $project->tasks()->get()->each(function ($task) {
            $task->delete();
        });
        $project->delete();
        return redirect('/');
    }
}