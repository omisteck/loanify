<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class LoanService {

    /**
     * Adds a new item to the cart.
     */
    public function loanBreakdownDetails( int $amount, int $tenure, string $repayment_day, int $interest): Collection
    {
        
        //Calculating the total interest, total amount, interest etc.

        $total_interest = $amount * ($interest /100);
        $total_amount = ($total_interest + $amount);
        $per_month_interest = $interest / $tenure;
        $per_payment = $amount * ($per_month_interest/100);
        $monthly_payment = $per_payment + ($amount/$tenure);

       return collect([
            "total_interest" => round($total_interest,2),
            "total_amount" => number_format($total_amount),
            "monthly_interest" => round($per_month_interest,2),
            "monthly_interest_payment" => number_format($per_payment,2),
            "monthly_payment" => number_format($monthly_payment,2),
            "repayment_days" => $this->getRepayment($tenure,$repayment_day),
       ]);
    }

    public function getRepayment( int $tenure, string $repayment_day ): array
    {
        //calculating repayment dates
        $repayment_day = Carbon::parse($repayment_day);
        $repayment_days = [];

        for ($i=0; $i < $tenure ; $i++) { 
                array_push($repayment_days, $repayment_day->addMonths(1)->toDateString());
        };

       return $repayment_days;
    }

}

?>