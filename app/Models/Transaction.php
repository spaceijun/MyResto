<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['trxdetail'];

    public function trxdetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
