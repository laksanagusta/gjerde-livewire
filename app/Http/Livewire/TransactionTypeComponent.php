<?php

namespace App\Http\Livewire;

use App\Models\TransactionType;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionTypeComponent extends Component
{
    use WithPagination;
    
    public $sortColumn = "code";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon fa-solid fa-caret-up"></i>';

    public $name = "";
    public $code = "";

    private function headerConfig()
    {
        return [
            'id' => '#',
            'code' => 'Code',
            'name' => 'Name',
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
              'code' => $this->code,
              'sortOrder' => $this->sortOrder,
              'sortColumn' => $this->sortColumn,
              'paginate' => 10
         ];

         $transactionTypes = TransactionType::searchTransactionTypes($params);

         return view('livewire.transaction.type.transaction-type-component', [
              'transactionTypes' => $transactionTypes,
              'headers' => $this->headerConfig()
         ]);
    }
}
