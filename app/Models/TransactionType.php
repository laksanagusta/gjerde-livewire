<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransactionType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code'];

    public static function searchTransactionTypes($params)
    {
        $resellers = TransactionType::when($params['name'], function($query, $name) {
            $query->where('name', 'LIKE', "%".$name."%");
       })->when($params['code'], function($query, $code){
            $query->where('code', 'LIKE', "%".$code."%");
       })->OrderBy($params['sortColumn'], $params['sortOrder'])->paginate($params['paginate']);

       return $resellers;
    }

    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
