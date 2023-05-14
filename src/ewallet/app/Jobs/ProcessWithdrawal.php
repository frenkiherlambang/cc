<?php

namespace App\Jobs;

use App\Events\UpdateBalance;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use App\Services\PaymentService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Middleware\WithoutOverlapping;

class ProcessWithdrawal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $amount;
    protected $orderId;
    protected $timestamp;

    public function __construct($user, $amount, $orderId, $timestamp)
    {
        $this->user = $user;
        $this->amount = $amount;
        $this->orderId = $orderId;
        $this->timestamp = $timestamp;
    }


    public function middleware(): array
    {
        return [new WithoutOverlapping($this->user->id)];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $paymentService = new PaymentService('Frenki Herlambang Prasetyo');
        $response = $paymentService->withdrawal($this->orderId, $this->amount, $this->timestamp);

        if (isset($response['status']) && $response['status'] == 1) {
            // create balance history
            $this->user->balanceHistories()->create([
                // make the amount negative
                'amount' => -$this->amount,
                'order_id' => $this->orderId,
                'timestamp' => Carbon::createFromTimestamp($this->timestamp)->toDateTimeString(),
            ]);
            $this->user->update(['balance' => $this->user->balance - $this->amount]); // Update the user's balance
            // dispatch event to refresh component
            event(new UpdateBalance($this->user->balance));
        }
    }
}
