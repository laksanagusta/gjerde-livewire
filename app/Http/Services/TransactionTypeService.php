<?php

namespace App\Http\Services;
use App\Models\TransactionType;

class TransactionTypeService {
    private $_transactionType;

    public function __construct(TransactionType $transactionType)
    {
        $this->_transactionType = $transactionType;
    }

    public function create($data){
        $data['code'] = strtoupper($data['code']);
        $this->_transactionType->create($data);
    }

    public function findById($id){
        return TransactionType::find($id);
    }

    public function updateOrCreate($data): TransactionType{
        $updatedTransactionType = $this->_transactionType->updateOrCreate(
            ['id' => $data['id']], 
            $data
        );

        return $updatedTransactionType;
    }
    
}