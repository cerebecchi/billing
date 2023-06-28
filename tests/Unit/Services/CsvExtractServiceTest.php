<?php
declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\CsvExtractService;
use Tests\TestCase;

class CsvExtractServiceTest extends TestCase
{
    private string $arrCsv = '[["name","governmentId","email","debtAmount","debtDueDate","debtId"],["John Doe","11111111111","johndoe@kanastra.com.br","1000000.00","2022-10-12","8291"],["Jo\u00e3o da Silva","056.765.875-23","joao.silva@kanastra.com","1000.00","2023-07-01","1"]]';
    private string $arrCorrectly = '[{"name":"John Doe","governmentId":"11111111111","email":"johndoe@kanastra.com.br","debtAmount":"1000000.00","debtDueDate":"2022-10-12","debtId":"8291"},{"name":"Jo\u00e3o da Silva","governmentId":"056.765.875-23","email":"joao.silva@kanastra.com","debtAmount":"1000.00","debtDueDate":"2023-07-01","debtId":"1"}]';

    /** @test */
    public function it_converts_csv_array_to_array_correctly()
    {
        $csvExtractService = new CsvExtractService();
        $arrCsv = json_decode($this->arrCsv, true);
        $arrCorrectly = json_decode($this->arrCorrectly, true);
        $result = $csvExtractService->convertArrayCsvToDefaultArray($arrCsv);
        $this->assertEquals($arrCorrectly, $result);
    }
}
