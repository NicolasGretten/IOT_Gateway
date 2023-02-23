<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;


class InvoiceController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Get(
     *     path="/api/users/stripe/{id}/invoices",
     *      operationId="list",
     *      tags={"Invoices"},
     *      summary="List all invoices",
     *      description="List all user's invoices.",
     *      @OA\Parameter(name="id",description="Customer id", required=true, in="query"),
     *      @OA\Parameter(name="including_pending",description="Including pending invoice", required=true, in="query"),
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
     *     path="/api/users/stripe/{id}/invoices/{invoice_id}",
     *      operationId="retrieve",
     *      tags={"Invoices"},
     *      summary="Retrieve an invoices",
     *      description="Retrieve an invoices.",
     *      @OA\Parameter(name="id",description="Customer id", required=true, in="query"),
     *      @OA\Parameter(name="invoice_id",description="Invoice Id", required=true, in="query"),
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
     * @OA\Get(
     *     path="/api/users/stripe/{id}/invoices/preview",
     *      operationId="preview",
     *      tags={"Invoices"},
     *      summary="Preview prorate",
     *      description="Preview prorate.",
     *      @OA\Parameter(name="id",description="Customer id", required=true, in="query"),
     *      @OA\Parameter(name="new_price",description="new price", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function preview(Request $request): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }
}

