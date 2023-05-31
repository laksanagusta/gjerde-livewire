<?php

namespace App\Http\Services;

use App\Models\Reseller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionService {
    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function create($data){
        try {
            $data['user_id'] = Auth::user()->id;
            $reseller = Reseller::find($data['reseller_id']);
            $data['location_id'] = $reseller['location_id'];

            $this->transaction->create($data);
        } catch (\Exception $e) {
            throw $e;
        }
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