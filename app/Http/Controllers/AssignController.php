<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\AssignProject;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;

class AssignController extends Controller
{

    public function show()
    {
        return view('assign-project.index');
    }

    public function list()
    {
        $assignedProjects = AssignProject::with(['project', 'client'])->get();
        return datatables()->of($assignedProjects)
            ->addColumn('project_name', function ($assignedProject) {
                return $assignedProject->project->name;
            })
            ->addColumn('client_name', function ($assignedProject) {
                return $assignedProject->client->name;
            })
            ->addColumn('client_email', function ($assignedProject) {
                return $assignedProject->client->email;
            })
            ->setRowAttr([
                'align'=>'center',
            ])
            ->make(true);
    }

    public function create()
    {
        $projects = Project::all();
        $clients = User::where('role', 'investor')->get();
        return view('assign-project.create', compact('projects', 'clients'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'projectId' => 'required|exists:projects,id',
            'clientId' => 'required|exists:users,id',
        ]);

        
        $assignment = AssignProject::create([
            'projectId' => $validated['projectId'],
            'clientId' => $validated['clientId'],
        ]);

        Session::flash('success', 'Assigned Project To Client Successfully!');
        return redirect()->route('assign.show');
    }

    public function edit($id)
    {
        $assignedProject = AssignProject::findOrFail($id);
        $projects = Project::all(); // Fetch all projects
        $clients = User::where('role', 'investor')->get(); // Fetch investors as clients
        return view('assign-project.edit', compact('assignedProject', 'projects', 'clients'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'projectId' => 'required|exists:projects,id', // Ensure projectId exists in the projects table
            'clientId' => 'required|exists:users,id' // Ensure clientId exists in the users table
        ]);

        $assignedProject = AssignProject::findOrFail($id);
        $assignedProject->update($validated);

        Session::flash('success', 'Assigned Project Updated Successfully!');
        return redirect()->route('assign.show');
    }

    public function delete(Request $request): JsonResponse
    {
        $assignedProject = AssignProject::findOrFail($request->id);
        $assignedProject->delete();

        return response()->json(['success' => true]);
    }

}