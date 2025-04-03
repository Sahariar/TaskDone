<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\TaskComments;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;

class SaProjectController extends Controller
{
    //

    public function dashboard(){
        $projects = Project::latest()->get();
        $user = User::latest()->get();

        $overallStats = [
            'total_projects' => $projects->count(),
            'total_tasks' => $projects->sum(function ($project) {
                return $project->tasksStatistics['total'];
            }),
            'total_completed' => $projects->sum(function ($project) {
                return $project->tasksStatistics['completed'];
            }),
            'todo' => $projects->sum(function ($project) {
                return $project->tasksStatistics['todo'];
            }),
            'average_progress' => $projects->avg('progress_statistics'),
            'total_users' => $user->count(),
        ];

        return view('dashboard' , compact('projects', 'overallStats'));
    }
    public function index()
    {
        //
        $projects = Project::latest()
        ->paginate(10);

        return view('admin.projects.index' , compact('projects'));
    }

    public function tasks()
    {
        //

        $tasks = Tasks::latest()
        ->paginate(10);

        return view('admin.tasks.index' , compact('tasks'));
    }

    public function taskshow(Tasks $task)
    {
        //
        $comments = TaskComments::where('task_id', $task->id)
        ->with('task') // Assuming you have a 'project' relationship defined in the Task model
        ->latest()
        ->paginate(10);
        return view('admin.tasks.show' , compact('task' , 'comments'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $tasks = Tasks::where('project_id', $project->id)
        ->with('project') // Assuming you have a 'project' relationship defined in the Task model
        ->latest()
        ->paginate(10);
        return view('admin.projects.show' , compact('project' , 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
