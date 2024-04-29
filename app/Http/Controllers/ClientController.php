<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{

    public function show()
    {
        return view('client.index');
    }

    public function list()
    {
        $clients = User::where('role', 'investor')->get();
        return datatables()->of($clients)
            ->setRowAttr([
                'align'=>'center',
            ])
            ->make(true);
    }

    public function create()
    {
        return view('client.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), // Hash the password for security
            'role' => 'investor', // Set the role to "investor"
        ]);

        Session::flash('success', 'Client Created Successfully!');
        return redirect()->route('client.show');
    }

    public function edit($id)
    {
        $client = User::query()->where('id', $id)->first();
        return view('client.edit', compact( 'client'));
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