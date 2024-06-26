<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\AssignProject;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{

    public function show()
    {
        return view('project.index');
    }

    public function list()
    {
        $project = Project::all();
        return datatables()->of($project)
           
            ->addColumn('status', function (Project $project){
                if ($project->status === 'active') {
                    return '<label class="btn btn-success">Active</label>';
                }
                return '<label class="btn btn-danger">Inactive</label>';
            })
            ->setRowAttr([
                'align'=>'center',
            ])
            ->rawColumns(['status'])
            ->make(true);
    }

    public function create()
    {
        return view('project.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string|max:45',
        ]);

        Project::query()->create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'status' => $validated['status'],
        ]);

        Session::flash('success', 'Project Created Successfully!');
        return redirect()->route('project.show');
    }

    public function edit($id)
    {
        $project = Project::query()->where('id', $id)->first();
        return view('project.edit', compact( 'project'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $this->validate($request, [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:45',
        ]);

        $project = Project::query()->where('id', $id)->first();
        if(!empty($project)) {
            $project->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'status' => $validated['status'],
            ]);
        }

        Session::flash('success', 'Project Updated Successfully!');
        return redirect()->route('project.show');
    }

    public function delete(Request $request): JsonResponse
    {
        $project = Project::query()->where('id', $request->id)->first();
        If (!empty($project)) {
            $project->delete();
        }
        return response()->json();
    }

    public function getProjectsByClient(Request $request)
    {
        //dd($request->all());
        // $clientId = $request->input('clientId');
        // $projects = Project::where('id', $clientId)->get();
        
        // return response()->json(['projects' => $projects]);
         // Get the client ID from the request
        $clientId = $request->input('clientId');

        // Fetch project IDs associated with the client from the client_assign_project table
        $projectIds = AssignProject::where('clientId', $clientId)->pluck('projectId');

        // Retrieve projects associated with the fetched project IDs
        $projects = Project::whereIn('id', $projectIds)->get();

        // Return the projects as JSON response
        return response()->json($projects);
    }

}