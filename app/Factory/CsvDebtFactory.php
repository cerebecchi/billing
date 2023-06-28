<?php
declare(strict_types=1);

namespace App\Factory;

use App\Models\Debt;
use App\Models\Debtor;
use App\Services\BilletService;
use App\Services\DebtService;
use App\Services\CsvExtractService;
use App\Services\DebtorService;
use App\Services\EmailDebtService;
use Illuminate\Http\UploadedFile;

class CsvDebtFactory
{

    private CsvExtractService $csvService;
    private DebtorService $debtorService;
    private DebtService $debtService;
    private BilletService $billetService;
    private $emailDebtService;

    public function __construct()
    {
        $this->csvService = new CsvExtractService();
        $this->debtorService = app(DebtorService::class);
        $this->debtService = app(DebtService::class);
        $this->billetService = new BilletService();
        $this->emailDebtService = new EmailDebtService();
    }

    public function csvDebtData(UploadedFile $csv): array|bool
    {
        $dataDebt = $this->csvService->extract($csv);
        if (!$dataDebt) {
            return false;
        }
        $debtsSaved = $this->saveCsvDebt($dataDebt);
        $debtsSaved = $this->billetService->generateBatch($debtsSaved);
        $this->sendEmailBatch($debtsSaved);

        return $debtsSaved;
    }

    public function saveCsvDebt(array $dataDebt): array
    {
        $debtsSaved = [];
        try{
            foreach ($dataDebt as $debt) {
                $debtor = $this->saveOrRecoverDebtor($debt);
                $debtSaved = $this->registerDebt($debt, $debtor);
                $debtsSaved[] = [
                    'Debtor' => $debtor,
                    'Debt' => $debtSaved,
                ];
            }
        } catch (\Exception $e) {
            sendExceptionToLog($e, 'saveCsvDebt', 'Error to Save debt');
        }

        return $debtsSaved;
    }

    private function saveOrRecoverDebtor(array $debt)
    {
        $debtor = [
            'name' => $debt['name'],
            'government_id' => $debt['governmentId'],
            'email' => $debt['email'],
        ];
        return $this->debtorService->saveOrRecoverDebtor($debtor);
    }

    private function registerDebt(array $debt, Debtor $debtor): ?Debt
    {
        $debtToRequister = [
            'id' => $debt['debtId'],
            'debtor_id' => $debtor->id,
            'debt_amount' => $debt['debtAmount'],
            'debt_due_date' => $debt['debtDueDate'],
        ];

        return $this->debtService->verifyAndRegister($debtToRequister);
    }

    private function sendEmailBatch(array $debt, ): void
    {
        $this->emailDebtService->sendEmailBatch($debt);
    }
}