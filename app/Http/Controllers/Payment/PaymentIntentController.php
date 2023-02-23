<?php

namespace App\Http\Controllers\Payment;


use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class PaymentIntentController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Get(
     *     path="/api/payment-intent/{payment_intent_id}",
     *      operationId="retrieve",
     *      tags={"Payment Intent"},
     *      summary="Retrieve a payment intent",
     *      description="Retrieve a payment intent.",
     *      @OA\Parameter(name="payment_intent_id",description="Payment Intent Id", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function retrieve(Request $request): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }
}

