<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Debt;
use App\Repositories\Db\DebtRepository;
use Illuminate\Support\Facades\Mail;
use stdClass;

class BilletService
{
    public function generateBatch(array $debts): array
    {
        foreach ($debts as $key => $debt) {
            $debts[$key]['billet'] = $this->generate($debt);
        }
        return $debts;
    }

    public function generate(array $debt): array
    {
        /**
         *
         * here the ticket will be generated
         *
         */
       return [
        'billet'
       ];
    }
}


