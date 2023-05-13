<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Http;

class PaymentServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testDeposit(): void
    {
         Http::fake([
            'https://nginx/*' => Http::response([
                'order_id' => '123456789',
                'amount' => 5000.00,
                'status' => 1,
            ], 200),
        ]);

         // Create an instance of the PaymentService
         $paymentService = new PaymentService('Frenki Herlambang Prasetyo');

         // Perform the deposit
         $orderId = '123456789';
         $amount = 5000.00;
         $timestamp = time();

         $result = $paymentService->deposit($orderId, $amount, $timestamp);

         $this->assertArrayHasKey('status', $result);
         $this->assertEquals(1, $result['status']);


    }
}
