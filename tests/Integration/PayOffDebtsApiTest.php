<?php

declare(strict_types=1);

namespace Tests\Integration;

use Tests\TestCase;

class PayOffDebtsApiTest extends TestCase
{
    public function testPayOffRequest()
    {
        $data = [
            "debtId" => "829188",
            "paidAt" => "2022-06-09 10:00:00",
            "paidAmount" => 100000.00,
            "paidBy" => "John Roe"
        ];
        $response = $this->postJson('api/payOff', $data);
        $response->assertStatus(200);
    }

    public function testPayOffNotFoundRequest()
    {
        $data = [
            "debtId" => "854000",
            "paidAt" => "2022-06-09 10:00:00",
            "paidAmount" => 100000.00,
            "paidBy" => "John Doe"
        ];
        $response = $this->postJson('api/payOff', $data);
        $response->assertStatus(404);
    }
}
