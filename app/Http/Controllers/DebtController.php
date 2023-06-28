<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Factory\CsvDebtFactory;
use App\Http\Requests\DebtRequest;

class DebtController extends Controller
{
    private CsvDebtFactory $csvDebtFactory;

    public function __construct(CsvDebtFactory $csvDebtFactory)
    {
        $this->csvDebtFactory = $csvDebtFactory;
    }

    public function store(DebtRequest $request)
    {
        $debt = $this->csvDebtFactory->csvDebtData($request->file('debt'));

        if (!$debt) {
            return response(['error' => 'Error saving debts'], 500);
        }

        return response()->json();
    }
}
