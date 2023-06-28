<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PayOffRequest;
use App\Http\Resources\PayOffResource;
use App\Services\PayOffService;

class PayOffController extends Controller
{
    private payOffService $payOffService;

    public function __construct(PayOffService $payOffService)
    {
        $this->payOffService = $payOffService;
    }

    public function store(PayOffRequest $request)
    {
        $payOff = $this->payOffService->payOffDebt($request->all());

        if (!$payOff) {
            return response(['error' => 'Error saving payOff'], 500);
        }

        return response()->json();
    }
}
