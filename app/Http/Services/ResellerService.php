<?php

namespace App\Http\Services;
use App\Models\Reseller;

class ResellerService {
    private $reseller;

    public function __construct(Reseller $reseller)
    {
        $this->reseller = $reseller;
    }

    public function create($data){
        $this->reseller->create($data);
    }

    public function findById($id){
        return Reseller::find($id);
    }

    public function updateOrCreate($data): Reseller{
        $updatedReseller = $this->reseller->updateOrCreate(
            ['id' => $data['id']], 
            $data
        );

        return $updatedReseller;
    }
    
}