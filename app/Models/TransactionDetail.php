<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $guarded = ["id"];
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
