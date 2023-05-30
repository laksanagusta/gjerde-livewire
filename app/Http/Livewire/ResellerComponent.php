<?php

namespace App\Http\Livewire;

use App\Models\Reseller;
use Livewire\Component;

class ResellerComponent extends Component
{
    
    public $sortColumn = "name";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon fa-solid fa-caret-up"></i>';

    public $name = "";

    private function headerConfig()
    {
        return [
            'id' => '#',
            'name' => 'Name',
            'address' => 'Address',
            'phoneNumber' => 'Phone Number',
            'location' => [
                'label' => 'Location',
                'func' => function($value) {
                    return $value->name;
                }
            ],
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

         $resellers = Reseller::searchResellers($params);

         return view('livewire.reseller.reseller-component', [
              'resellers' => $resellers,
              'headers' => $this->headerConfig()
         ]);
    }
}
