<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reseller extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'phoneNumber', 'location_id'];

    public static function searchResellers($params)
    {
        $resellers = Reseller::with('location:id,name')->when($params['name'], function($query, $name) {
            return $query->where('resellers.name', 'LIKE', "%".$name."%");
       })->OrderBy($params['sortColumn'], $params['sortOrder'])->paginate($params['paginate']);

       return $resellers;
    }

    public function location(): HasOne
    {
        return $this->hasOne(Location::class);
    }

    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
