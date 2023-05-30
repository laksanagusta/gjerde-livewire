<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Services\TransactionService;
use App\Models\Location;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Contracts\View\View;

class TransactionController extends Controller
{
    public function index(): View
    {
        return view('transactions.index', [
            'transactions' => Transaction::paginate(10)
        ]);
    }


    public function create(): View
    {
        $transactionTypes = TransactionType::find();
        return view('transactions.create',[
            'transactionTypes' => $transactionTypes
        ]);
    }

    public function store(TransactionRequest $request, TransactionService $transactionService)
    {
        $transactionService->create($request->all());
        return view('transactions.index', [
            'transactions' => Transaction::paginate(10)
        ]);
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id, TransactionService $transactionService)
    {
        $locations = Location::all();
        $transaction = $transactionService->findById($id);
        return view('transactions.edit', [
            'transaction' => $transaction,
            'locations' => $locations
        ]);
    }

    public function update(TransactionRequest $request, string $id, TransactionService $transactionService)
    {
        $transactionService->updateOrCreate($request->all());
        return view('transactions.index', [
            'transactions' => Transaction::paginate(10)
        ]);
    }

    public function destroy(string $id)
    {
           
    }
}
