<?php

namespace App\Http\Controllers\Payment;

use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebhookController
{
    use MicroserviceTrait;

    /**
     * Handle a Stripe webhook call.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function handleWebhook(Request $request): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }
}
