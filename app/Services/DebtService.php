<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Debt;
use App\Repositories\Db\DebtRepository;

class DebtService
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

    public function verifyAndRegister(array $debt): ?Debt
    {
        if (!empty($this->debtRepository->find($debt['id'])->id)) {
            \Log::info('verifyAndRegister: existing debt', $debt);

            return null;
        }
        $debt = $this->debtRepository->create($debt);

        return $debt;
    }
}


