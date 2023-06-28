<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Debt;
use App\Exceptions\CsvDebtException;
use Illuminate\Http\UploadedFile;

class CsvExtractService
{

    public function extract(UploadedFile $csv): array|false
    {

        if ($csv->getClientOriginalExtension() !== 'csv') {
            return false;
        }

        $path = $csv->getRealPath();

        $data = array_map('str_getcsv', file($path));

        return $this->convertArrayCsvToDefaultArray($data);
    }

    public function convertArrayCsvToDefaultArray(array $data): array
    {
        $debtList = [];
        $headers = array_shift($data);
        try {
            foreach ($data as $row) {
                $dataRow = [];
                foreach ($headers as $headerKey => $header) {
                    $dataRow[$header] = $row[$headerKey];
                }
                $debtList[] = $dataRow;
            }
        } catch (\Exception $e) {
            throw new CsvDebtException('Error processing CSV record: ' . $e->getMessage());
        }
        return $debtList;
    }

}


