<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class PayOffException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        sendExceptionToLog($this, 'CsvDebtException', $this->getMessage());
    }
}
