<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\APITransactionRequest;
use App\Http\Services\DashboardService;


class ApiTransactionController extends Controller
{
    public function fetchReport(APITransactionRequest $request)
    {
        $dashboardService = new DashboardService($request->startTime, $request->endTime);
        $dashboardService->getTransactionByRange();
        $transactionInOut = $dashboardService->getTransactionInOut();

        return $transactionInOut;
    }
}
