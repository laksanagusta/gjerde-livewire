<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
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
            'email' => 'Email',
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

         $users = User::searchUsers($params);

         return view('livewire.user.user-component', [
              'users' => $users,
              'headers' => $this->headerConfig()
         ]);
    }
}
