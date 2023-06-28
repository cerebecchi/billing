<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class CsvDebtException extends Exception
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
