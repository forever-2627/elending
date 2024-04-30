<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanState extends Model
{
    use HasFactory;

    protected $fillable = [
      'id',
      'name'
    ];

    public function loans(){
        $this->hasMany(Loan::class);
    }
}
