<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\AssignProject;
use App\Models\CashInvestment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;

class CashController extends Controller
{

    public function show()
    {
        return view('cash.index');
    }

    public function list()
    {
        $cashInvestments = CashInvestment::with(['project', 'client'])->get();
        return datatables()->of($cashInvestments)
            ->addColumn('project_name', function ($cashInvestment) {
                return $cashInvestment->project->name;
            })
            ->addColumn('client_name', function ($cashInvestment) {
                return $cashInvestment->client->name;
            })
            ->addColumn('client_email', function ($cashInvestment) {
                return $cashInvestment->client->email;
            })
            ->setRowAttr([
                'align' => 'center',
            ])
            ->make(true);
    }

    public function create()
    {
        $projects = Project::all();
        $clients = User::where('role', 'investor')->get();
        return view('cash.create', compact('projects', 'clients'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'clientId' => 'required|exists:users,id',
            'projectId' => 'required|exists:projects,id',
            'cashAmount' => 'required|array',
            'cashAmount.*' => 'numeric',
            'cashDate' => 'required|array',
            'cashDate.*' => 'date',
        ]);

        // Create cash investment records for each cash amount and date
        foreach ($validatedData['cashAmount'] as $key => $amount) {
            $cashInvestment = new CashInvestment();
            $cashInvestment->projectId = $validatedData['projectId'];
            $cashInvestment->clientId = $validatedData['clientId'];
            $cashInvestment->amount = $amount;
            $cashInvestment->invest_date = $validatedData['cashDate'][$key];
            $cashInvestment->save();
        }

        // Optionally, you can return a response or redirect the user
        return redirect()->route('cash.show');
    }
    public function edit($id)
    {
        $cashInvestment = CashInvestment::findOrFail($id);
        $projects = Project::all();
        $clients = User::where('role', 'investor')->get();
        return view('cash.edit', compact('cashInvestment', 'projects', 'clients'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'clientId' => 'required|exists:users,id',
            'projectId' => 'required|exists:projects,id',
            'amount' => 'required|numeric',
            'investDate' => 'required|date',
        ]);
    
        $cashInvestment = CashInvestment::findOrFail($id);
        $cashInvestment->update([
            'client_id' => $validated['clientId'],
            'project_id' => $validated['projectId'],
            'amount' => $validated['amount'],
            'invest_date' => $validated['investDate'],
        ]);
    
        Session::flash('success', 'Cash Investment Updated Successfully!');
        return redirect()->route('cash.show');
    }

    public function delete(Request $request): JsonResponse
    {
        $assignedProject = AssignProject::findOrFail($request->id);
        $assignedProject->delete();

        return response()->json(['success' => true]);
    }

}