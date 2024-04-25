<?php

namespace App\Events;

use App\Models\Repayment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RepaymentUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $loan_id;

    /**
     * Create a new event instance.
     * @param $repayments
     */
    public function __construct($loan_id)
    {
        $this->loan_id = $loan_id;
    }
}
