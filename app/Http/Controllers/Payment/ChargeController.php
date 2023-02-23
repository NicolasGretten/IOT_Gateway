<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
class ChargeController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Get(
     *     path="/api/users/stripe/{id}/charges",
     *      operationId="list",
     *      tags={"Charges"},
     *      summary="List all the user charges",
     *      description="List all the user charges",
     *      @OA\Parameter(name="id",description="User id", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function list(Request $request): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }

    /**
     * @OA\Get(
     *     path="/api/users/stripe/{id}/charges/{charge_id}",
     *      operationId="retrieve",
     *      tags={"Charges"},
     *      summary="Retrieve a charge",
     *      description="Retrieve a charge",
     *      @OA\Parameter(name="id",description="User id", required=true, in="query"),
     *      @OA\Parameter(name="charge_id",description="Charge Id", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function retrieve(Request $request): Response|ResponseFactory
    {
        return $this->uri($request, env("PAYMENT_API"));
    }
}

