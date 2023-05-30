<?php

namespace App\Http\Services;
use App\Models\Location;

class LocationService {
    private $location;

    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    public function create($data){
        $this->location->create($data);
    }

    public function findById($id){
        return Location::find($id);
    }

    public function updateOrCreate($data): Location{
        $updatedLocation = $this->location->updateOrCreate(
            ['id' => $data['id']], 
            $data
        );

        return $updatedLocation;
    }
    
}