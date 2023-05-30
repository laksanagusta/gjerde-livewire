<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;

class TransactionComponent extends Component
{
    public $sortColumn = "name";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon fa-solid fa-caret-up"></i>';

    public $name = "";

    private function headerConfig()
    {
        return [
            'id' => '#',
            'grandTotal' => 'Grand Total',
            'description' => 'description',
            'created_at' => [
                'label' => 'Date Created',
                'func' => function($value) {
                    return $value->diffForHumans();
                }
            ]
        ];
    }   

    public function updated(){
         $this->resetPage();
    }

    public function sort($columnName=""){
         if($this->sortOrder == 'asc'){
              $this->sortOrder = 'desc';
         }else{
              $this->sortOrder = 'asc';
         } 

         $this->sortColumn = $columnName;
    }

    public function render(){
         $params = [
              'name' => $this->name,
              'sortOrder' => $this->sortOrder,
              'sortColumn' => $this->sortColumn,
              'paginate' => 10
         ];

         $transactions = Transaction::searchTransactions($params);

         return view('livewire.transaction.transaction-component', [
              'transactions' => $transactions,
              'headers' => $this->headerConfig()
         ]);
    }
}
