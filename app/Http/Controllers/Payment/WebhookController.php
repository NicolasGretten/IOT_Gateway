<?php

namespace App\Http\Controllers\Payment;

use App\Jobs\WebhookJob;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WebhookController
{
    /**
     * Handle a Stripe webhook call.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function handleWebhook(Request $request): JsonResponse
    {
        if(!empty($request)) {
            $payload = json_decode($request->getContent(), true);

            WebhookJob::dispatch($payload)->onQueue('webhook');

            return $this->webhookSuccess($payload);
        }

        return $this->webhookError(['error' => 'Request empty.']);
    }

    public function webhookSuccess(array $webhook): JsonResponse
    {
        return response()->json([
            'status' => 'SUCCESS',
            'webhook' => [
                'id' => $webhook['id']
            ]
        ], 201);
    }

    public function webhookError(array $webhook): JsonResponse
    {
        return response()->json([
            'status' => 'FAILURE',
            'error' => $webhook['error']
        ], 409);
    }
}
