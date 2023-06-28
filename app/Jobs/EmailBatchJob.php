<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\EmailDebtService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EmailBatchJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private array $debt;

    private EmailDebtService $emailDebtService;

    public function __construct(array $debt)
    {
        $connection = env('QUEUE_CON');
        $this->onConnection($connection);
        $this->onQueue('queue-billing');

        $this->debt = $debt;
        $this->emailDebtService = new EmailDebtService();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->emailDebtService->sendEmail($this->debt);
    }
}
