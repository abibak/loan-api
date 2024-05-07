<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::orderBy('created_at', 'DESC')->orderBy('amount', 'DESC')->simplePaginate(5);
        return response()->json(['data' => $loans, 'message' => 'Received']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'bail|required|int|exists:users,id',
            'amount' => 'bail|required|int'
        ]);

        $loanCreated = Loan::create($request->all());

        return response()->json(['data' => $loanCreated, 'message' => 'Successfully created'], 201);
    }

    public function show($id)
    {
        $findModel = Loan::findOrFail($id);
        return response()->json(['data' => $findModel, 'message' => 'Received']);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'amount' => 'bail|int',
            'status' => 'bail|boolean'
        ]);

        $updatedModel = Loan::findOrFail($id);
        $updatedModel->update($request->all());

        return response()->json(['data' => $updatedModel, 'message' => 'Successfully updated']);
    }

    public function delete($id)
    {
        $findModel = Loan::findOrFail($id);
        $findModel->delete($id);

        return response()->json(['data' => $findModel, 'message' => 'Successfully deleted']);
    }
}
