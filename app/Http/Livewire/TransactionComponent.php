<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionComponent extends Component
{
    use WithPagination;

    public $sortColumn = "description";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon fa-solid fa-caret-up"></i>';

    public $description = "";

    private function headerConfig()
    {
        return [
            'id' => '#',
            'description' => 'Description',
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

    public function sort($columnName=''){
          $this->sortOrder = ($this->sortOrder == 'asc') ? 'desc' : 'asc';
         $this->sortColumn = $columnName;
    }

    public function render(){
         $params = [
              'description' => $this->description,
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
