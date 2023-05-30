<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionTypeRequest;
use App\Http\Services\TransactionTypeService;
use App\Models\Location;
use App\Models\TransactionType;
use Illuminate\Contracts\View\View;

class TransactionTypeController extends Controller
{
    public function index(): View
    {
        return view('transactions.types.index', [
            'transactionTypes' => TransactionType::paginate(10)
        ]);
    }


    public function create(): View
    {
        $locations = Location::all();
        return view('transactions.types.create',[
            'locations' => $locations
        ]);
    }

    public function store(TransactionTypeRequest $request, TransactionTypeService $transactionTypeService)
    {
        $transactionTypeService->create($request->all());
        return view('transactions.types.index', [
            'transactionTypes' => TransactionType::paginate(10)
        ]);
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id, TransactionTypeService $transactionTypeService)
    {
        $transactionType = $transactionTypeService->findById($id);
        return view('transactions.types.edit', $transactionType);
    }

    public function update(TransactionTypeRequest $request, string $id, TransactionTypeService $transactionTypeService)
    {
        $transactionTypeService->updateOrCreate($request->all());
        return view('transactions.types.index', [
            'transactionTypes' => TransactionType::paginate(10)
        ]);
    }

    public function destroy(string $id)
    {
           
    }
}
