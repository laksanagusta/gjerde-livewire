<?php

namespace App\Http\Services;
use App\Models\Transaction;

class TransactionService {
    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function create($data){
        $this->transaction->create($data);
    }

    public function findById($id){
        return Transaction::find($id);
    }

    public function updateOrCreate($data): Transaction{
        $updatedTransaction = $this->transaction->updateOrCreate(
            ['id' => $data['id']], 
            $data
        );

        return $updatedTransaction;
    }
    
}