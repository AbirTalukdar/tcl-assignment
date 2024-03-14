<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Investment;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        Project::create($request->all());

        return redirect()->route('home');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'duration' => 'required|date',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index');
    }

    public function investors($projectId)
    {
        $project = Project::findOrFail($projectId);
        $investors = Investment::where('project_id', $projectId)
        ->with('user') // Assuming you have a relationship set up with the User model
        ->get();

    return view('investors.investors', compact('project', 'investors'));
    }

    public function projectList(Request $request)
    {
        {
            if ($request->ajax()) {
                $data = Project::select('*');
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
         
                            if (Auth::check() && Auth::user()->role === 'investor') {
                                $button = '<button type="button" class="btn btn-primary invest-btn" data-project-id="'.$row->id.'">Invest</button>';
                                return $button;
                            } else {
                                $button = '<a href="'.route('projects.investors', $row->id).'" class="btn btn-primary">Invest Details</a>';
                                return $button;
                            }
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            return view('projects.projectList');
        }
    }
}
