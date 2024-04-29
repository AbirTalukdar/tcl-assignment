<?php

namespace App\Http\Controllers;

use App\Models\Project;
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
            'vendor_firstName' => 'required|string|max:255',
            'vendor_lastName' => 'required|string|max:255',
            'vendor_phone' => 'required|string|max:255',
            'vendor_shop_name' => 'required|string|max:255',
            'status' => 'required|string|max:45',
        ]);

        Project::query()->create([
            'vendor_firstName' => $validated['vendor_firstName'],
            'vendor_lastName' => $validated['vendor_lastName'],
            'vendor_phone' => $validated['vendor_phone'],
            'vendor_shop_name' => $validated['vendor_shop_name'],
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
            'vendor_firstName' => 'nullable|string|max:255',
            'vendor_lastName' => 'nullable|string|max:255',
            'vendor_phone' => 'nullable|string|max:255',
            'vendor_shop_name' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:45',
        ]);

        $project = Project::query()->where('id', $id)->first();
        if(!empty($project)) {
            $project->update([
                'vendor_firstName' => $validated['vendor_firstName'],
                'vendor_lastName' => $validated['vendor_lastName'],
                'vendor_phone' => $validated['vendor_phone'],
                'vendor_shop_name' => $validated['vendor_shop_name'],
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

}