<?php

declare(strict_types=1);

namespace Tests\Integration\Factories;

use App\Factory\CsvDebtFactory;
use App\Models\Debt;
use App\Models\Debtor;
use Tests\TestCase;

class CsvDebtFactoryTest extends TestCase
{
    private string $dataToSave = '[{"name":"John Doe","governmentId":"22222222222","email":"johndooooe@kanastra.com.br","debtAmount":"1000000.00","debtDueDate":"2022-10-12","debtId":"829188"}]';

    public function testSaveDebtFlow()
    {
        $debit = Debt::find(829188);
        $debtor = Debtor::where('government_id', '22222222222')->first();
        if (!empty($debit->id)) {
            $debit->delete();
        }
        if (!empty($debtor->id)) {
            $debtor->delete();
        }
        $csvDebtFactory = new CsvDebtFactory();
        $csvDebtFactory->saveCsvDebt(json_decode($this->dataToSave, true));
        $this->assertTrue(!empty(Debt::find(829188)->id));
    }

}
