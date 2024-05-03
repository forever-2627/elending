<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DueLoan extends Model
{
    private $loan;

    public function __construct()
    {
        $this->loan = new Loan();
    }

    use HasFactory;

    protected $fillable = [
        'current_date',
        'due_amount',
        'loan_id',
        'is_paid'
    ];

    public function loan(){
        $this->belongsTo(Loan::class);
    }

    public function update_table(){
        $current_date = date('m/d/Y');
        $existing_due_loan = DueLoan::where(['current_date' => $current_date])->first();
        if(!$existing_due_loan){
            DueLoan::truncate();
            if(count($this->loan->get_issued_loans()) > 0){
                $issued_loan_ids = $this->loan->get_issued_loans()['loan_id'];
                $issued_loan_amounts = $this->loan->get_issued_loans()['amount'];
                $issued_loan_due_date = $this->loan->get_issued_loans()['due_date'];
                foreach ($issued_loan_ids as $key => $issued_loan_id){
                    DueLoan::create([
                        'current_date' => $issued_loan_due_date[$key],
                        'due_amount' => $issued_loan_amounts[$key],
                        'loan_id' => $issued_loan_id,
                        'is_paid' => 0
                    ]);
                }
            }
        }
    }
}
