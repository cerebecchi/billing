<?php

declare(strict_types=1);

namespace App\Services;

use App\Jobs\EmailBatchJob;
use Illuminate\Support\Facades\Mail;

class EmailDebtService
{
    public function sendEmailBatch(array $debts): void
    {
        foreach ($debts as $debt) {
            $emailBatchJob = new EmailBatchJob(
                $debt,
            );
            dispatch($emailBatchJob);
        }
    }

    public function sendEmail(array $debt): bool
    {
        if (empty($debt['Debt'])) {
            return false;
        }
        $data = [
            'name' => $debt['Debtor']->name,
            'debtAmount' => $debt['Debt']->debt_amount,
            'debtDueDate' => $debt['Debt']->debt_due_date,
            'billet' => $debt['billet'],
        ];

        \Log::info('emailSend', $data);
        return true;// lock placed due to lack of connection with the email, if you have just remove this line

        Mail::send('mail', $data, function($message) use ($debt) {
            $message->to($debt['Debtor']->email, $debt['Debtor']->name)->subject
               ('Outstanding debts');
            $message->from('system@kanastra.com','Ticket Collector');
         });

        return true;
    }
}


