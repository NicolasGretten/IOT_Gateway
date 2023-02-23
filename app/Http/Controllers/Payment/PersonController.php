<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;


class PersonController extends Controller
{
    use MicroserviceTrait;

    /**
     *  @OA\Get(
     *     path="/api/stores/wallets/{id}/persons",
     *      operationId="list",
     *      tags={"Persons"},
     *      summary="List all Person",
     *      description="List all person.",
     *      @OA\Parameter(name="id",description="Wallet Id", required=true, in="query"),
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
     *  @OA\Get(
     *     path="/api/stores/wallets/{id}/persons/{person_id}",
     *      operationId="retrieve",
     *      tags={"Persons"},
     *      summary="Retrieve a person",
     *      description="Retrieve a person.",
     *      @OA\Parameter(name="id",description="Wallet Id", required=true, in="query"),
     *      @OA\Parameter(name="person_id",description="Person ID", required=true, in="query"),
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

    /**
     *  @OA\Post(
     *     path="/api/stores/wallets/{id}/persons",
     *      operationId="create",
     *      tags={"Persons"},
     *      summary="Create a person",
     *      description="Create a person.",
     *      @OA\Parameter(name="id",description="Wallet Id", required=true, in="query"),
     *      @OA\Parameter(name="person_token",description="Person token", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function create(Request $request): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }
}

