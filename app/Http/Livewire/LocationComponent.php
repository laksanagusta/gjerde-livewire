<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Livewire\Component;
use Livewire\WithPagination;

class LocationComponent extends Component
{
    use WithPagination;

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

          $locations = Location::searchLocations($params);

          return view('livewire.location.location-component', [
               'locations' => $locations,
               'headers' => $this->headerConfig()
          ]);
     }

}
