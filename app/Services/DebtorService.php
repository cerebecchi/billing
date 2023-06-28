<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Debtor;
use App\Repositories\Db\DebtorRepository;

class DebtorService
{
    private $debtorRepository;

    public function __construct(DebtorRepository $debtorRepository)
    {
        $this->debtorRepository = $debtorRepository;
    }

    public function saveOrRecoverDebtor(array $debtor): ?Debtor
    {
        return $this->debtorRepository->firstOrNewByGovernmentId($debtor);
    }
}


