<?php

namespace App\Http\Services;

use App\Models\Reseller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
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

            $newTransaction = $this->transaction->create($data);

            $this->mappingAndInsertTransactionDetail($data, $newTransaction->id);

            if(isset($data['transactionDetail'])){

            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function findById($id){
        return Transaction::find($id);
    }

    public function mappingAndInsertTransactionDetail($trxDetailData, $transactionId){
        $toArrayTransactionDetail = json_decode($trxDetailData['transactionDetail'], true);

        $mappingTransactionDetail = collect($toArrayTransactionDetail)->map(function ($value) use ($transactionId){
            $result = [
                'product_id' => $value['id'],
                'transaction_id' => $transactionId,
                'qty' => $value['qty'],
                'subtotal' => $value['subtotal']
            ];
            return $result;
        })->toArray();

        TransactionDetail::insert($mappingTransactionDetail);
    }

    public function updateOrCreate($data): Transaction{
        $updatedTransaction = $this->transaction->updateOrCreate(
            ['id' => $data['id']], 
            $data
        );

        return $updatedTransaction;
    }
    
}