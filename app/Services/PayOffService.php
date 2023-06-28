<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\PayOffException;
use App\Models\Debt;
use App\Repositories\Db\DebtRepository;

class PayOffService
{
    private $debtRepository;

    public function __construct(DebtRepository $debtRepository)
    {
        $this->debtRepository = $debtRepository;
    }

    public function register(array $debt): Debt
    {
        return $this->debtRepository->create($debt);
    }

    public function payOffDebt(array $data): Debt|bool
    {
        $debt = false;
        /**
         * was thought to use laravel "resource" but ignored because of time
         */
        $data = [
            'id' => $data['debtId'],
            'paid_at' => $data['paidAt'],
            'paid_amount' => $data['paidAmount'],
            'paid_by' => $data['paidBy'],
        ];
        try {
            $debt = $this->debtRepository->update($data['id'], $data);
        } catch (\Exception $e) {
            throw new PayOffException('Error during payment update: ' . $e->getMessage());
        }

        return $debt;
    }
}


