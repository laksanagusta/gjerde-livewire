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
        $transactions = Transaction::with('reseller')->with('user')->with('location')
        ->when(isset($params['description']) && !empty($params['description']), function($query, $description) {
            return $query->where('transactions.description', 'LIKE', "%".$description."%");
        })
        ->when(isset($params['startTime']) && !empty($params['description']), function($query, $startTime){
            return $query->where('transactions.created_at', '>=', $startTime);
        })
        ->when(isset($params['endTime']) && !empty($params['description']), function($query, $endTime){
            return $query->where('transactions.created_at', '<=', $endTime);
        });

        if(isset($params['sortColumn']) && isset($params['sortOrder'])){
            $transactions->OrderBy($params['sortColumn'], $params['sortOrder']);
        }

        if(isset($params['paginate'])){
            $transactions = $transactions->paginate($params['paginate']);
        }else{
            $transactions = $transactions->get();
        }

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
