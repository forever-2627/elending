<?php

namespace App\Listeners;

use App\Models\Loan;
use App\Models\Repayment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateLoanAmount
{
    public $loan_id;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @param $event
     */
    public function handle($event): void
    {
        $this->loan_id = $event->loan_id;
        $repayments = Repayment::where(['loan_id' => $this->loan_id])->get();
        $total_repaid = 0;
        foreach ($repayments as $repayment){
            $total_repaid += $repayment->repaid_amount * 1;
        }
        $loan = Loan::find($this->loan_id);
        //Admin can input amount repaid to date not to only zero. so when update it we have to consider about it.
        //$loan->amount_repaid_to_date = $loan->total_to_be_repaid - $loan->initial_total_to_be_repaid + $total_repaid;
		$loan->amount_repaid_to_date = $total_repaid;
        $loan->outstanding_balance = $loan->initial_total_to_be_repaid - $total_repaid;
        $loan->update();
    }
}
