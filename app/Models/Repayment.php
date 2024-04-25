<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'repaid_date',
        'repaid_amount'
    ];

    public function loan(){
        return $this->belongsTo(Loan::class);
    }

    public function user(){
        return User::find($this->loan()->get());
    }
}
