<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        $projects = Project::with('status')->paginate(100);
        return view('projects.index')
        ->with('projects', $projects);
        
    }

    public function create()
    {
        $statuses = Status::all();
        return view('projects.create')
        ->with('statuses', $statuses);
    }

    public function store(Request $request)
    {
        $request->validate([

            'project_name' => 'required',
            'client_name' => 'required',
            'tlp_client' => 'required',
            'project_information' => 'required',
            'budget' => 'required',
            'status_id' => 'required',
        ]);

        $project = new Project;
        $project->project_name = $request->project_name;
        $project->client_name = $request->client_name;
        $project->tlp_client = $request->tlp_client;
        $project->project_information = $request->project_information;
        $project->budget = $request->budget;
        $project->status_id = $request->status_id;
        $project->save();

        return redirect('/projects')
                        ->with('success','Berhasil Menyimpan !');
    }

    public function edit($projectId)
    {
        $project = Project::findOrFail($projectId);
        $statuses = Status::all();
        return view('projects.edit', compact('project', 'statuses'))
        ->with('statuses', $statuses);
    }

    public function update(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);
        $project->status_id = $request->status_id;
        $project->project_name = $request->project_name;
        $project->client_name = $request->client_name;
        $project->tlp_client = $request->tlp_client;
        $project->project_name = $request->project_name;
        $project->project_information = $request->project_information;
        $project->budget = $request->budget;
        $project->save();
        return redirect('/projects') 
            ->with('success','Berhasil Update !');
    }

    public function destroy($projectId)
    {
        $project = Project::findOrFail($projectId);
        $project->delete();

        return redirect('/projects')
                        ->with('success','Berhasil Hapus !');
    }
}


