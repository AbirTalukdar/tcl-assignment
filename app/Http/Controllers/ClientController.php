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
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255'
        ]);

        $client = User::query()->where('id', $id)->first();
        if(!empty($client)) {
            $client->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]);
        }

        Session::flash('success', 'Client Record Updated Successfully!');
        return redirect()->route('client.show');
    }

    public function delete(Request $request): JsonResponse
    {
        $client = User::query()->where('id', $request->id)->first();
        If (!empty($client)) {
            $client->delete();
        }
        return response()->json();
    }

}