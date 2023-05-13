<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class PaymentService
{

    // decleare api token variable
    private $apiToken;

    public function __construct(?string $apiToken = null)
    {
        $this->apiToken = $apiToken;
    }


    public function deposit(string $orderId, float $amount, $timestamp)
    {

        // get self url from this app

        $url = env('PAYMENT_SERVICE_URL') . '/deposit';

        $payload = [
            'order_id' => $orderId,
            'amount' => $amount,
            'timestamp' => $timestamp,
        ];

        try {
            // add authencation bearer token to the request
            $response = Http::withToken($this->generateToken($this->apiToken))->post($url, $payload);

            // Process the response as needed
            $responseData = $response->json();

            // Return any relevant response or data
            return $responseData;
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    // create function that generate base64 token with string argument
    public function generateToken($string)
    {
        // return base64 encoded string
        return base64_encode($string);
    }
}
