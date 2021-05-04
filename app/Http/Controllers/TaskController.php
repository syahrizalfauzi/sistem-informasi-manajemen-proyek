<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $nama = Auth::user()->nama;
        return view('tasks.create', ['project' => $project, 'nama' => $nama]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'max:255',
            'status' => 'required'
        ]);

        $task = new Task();
        $task->judul = $request->judul;
        $task->deskripsi = $request->deskripsi;
        $task->status = $request->status;
        $task->project_id = $project->id;
        $task->save();

        return redirect('projects/' . $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Task $task)
    {
        $nama = Auth::user()->nama;
        return view('tasks.show', ['task' => $task, 'project' => $project, 'nama' => $nama]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Task $task)
    {
        $nama = Auth::user()->nama;
        return view('tasks.edit', ['task' => $task, 'project' => $project, 'nama' => $nama]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'max:255',
            'status' => 'required'
        ]);

        $task->judul = $request->judul;
        $task->deskripsi = $request->deskripsi;
        $task->status = $request->status;
        $task->update();

        if ($request->from == 'task')
            return redirect('projects/' . $project->id . '/tasks/' . $task->id);

        return redirect('projects/' . $project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return redirect('projects/' . $project->id);
    }
}