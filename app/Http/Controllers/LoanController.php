<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Services\LoanService;
use App\Traits\ResponseTrait;
use App\Http\Requests\StoreLoanRequest;


class LoanController extends Controller
{
use ResponseTrait;

protected $loanService;

public function __construct(LoanService $loanService)
{
    $this->loanService = $loanService;
}
/**
 * Store a newly created resource in storage.
 *
 * @param  \App\Http\Requests\StoreLoanRequest  $request
 * @return \Illuminate\Http\Response
 */
public function store(StoreLoanRequest $request)
{
    //handling all logic in service class 
    $breakdown = $this->loanService->loanBreakdownDetails($request->amount, $request->tenure, $request->repayment_date, $request->interest);   
    return $this->successResponse($breakdown, 200, 'Loan breakdown successfully calculated!');
}
}
