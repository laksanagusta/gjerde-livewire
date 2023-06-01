<?php

namespace App\Http\Services;
use App\Models\Location;
use App\Models\Transaction;
use App\Models\TransactionType;

class DashboardService {
    protected $startTime;
    protected $endTime;
    protected $transactionData;
    protected $typeTransaction;
    protected $transactionType;

    public function __construct($startTime, $endTime)
    {
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    public function getTransactionByRange(){
        $this->transactionData = Transaction::searchTransactions([
            'startTime' => $this->startTime,
            'endTime' => $this->endTime
        ]);
    }

    public function getTransactionInOut(){
        $result2 = [];
        $result1= [];

        foreach($this->transactionData as $transactionDatas){
            $substrMonth = substr($transactionDatas['created_at'], 5, 2);
            if(!isset(${'result' . $transactionDatas['transaction_type_id']}[$substrMonth])){
                ${'result' . $transactionDatas['transaction_type_id']}[$substrMonth] = $transactionDatas['grandTotal'];
            }else{
                ${'result' . $transactionDatas['transaction_type_id']}[$substrMonth] += $transactionDatas['grandTotal'];
            }
        }

        ksort($result2);
        ksort($result1);

        $result2Value = array_values($result2);
        $result2Label = array_values(array_flip($result2));
        $result1Value = array_values($result1);
        $result1Label = array_values(array_flip($result2));

        return [
            'resultIn' => [
                'label' => $result2Label,
                'value' => $result2Value
            ],
            'resultOut' => [
                'label' => $result1Label,
                'value' => $result1Value
            ]
        ];
    }

    private function mappingLabel(){

    }
}