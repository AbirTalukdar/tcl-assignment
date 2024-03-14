<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;

class InvestmentController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'project_id' => 'required|exists:projects,id',
        'amount' => 'required|numeric|min:0',
    ]);

    Investment::create([
        'project_id' => $request->project_id,
        'user_id' => auth()->id(),
        'amount' => $request->amount,
    ]);

    return response()->json(['message' => 'Investment added successfully'], 200);
}
}
