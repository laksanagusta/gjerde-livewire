<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address'];

    public static function searchLocations($params)
    {
        $locations = Location::select('created_at', 'id', 'name', 'address')->when($params['name'], function($query, $name) {
            return $query->where('name', 'LIKE', "%".$name."%");
       })->OrderBy($params['sortColumn'], $params['sortOrder'])->paginate($params['paginate']);

       return $locations;
    }

    public function reseller(): HasMany
    {
        return $this->hasMany(Reseller::class);
    }
    
}
