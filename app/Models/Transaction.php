<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'grandTotal', 'location_id', 'transaction_type_id', 'user_id', 'reseller_id'];

    public static function searchTransactions($params)
    {
        $transactions = Transaction::with('reseller')->with('user')->with('location')->when($params['description'], function($query, $description) {
            return $query->where('transactions.description', 'LIKE', "%".$description."%");
       })->OrderBy($params['sortColumn'], $params['sortOrder'])->paginate($params['paginate']);

       return $transactions;
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Reseller::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
