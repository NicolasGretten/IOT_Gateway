<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class PaymentMethodController extends Controller
{
    use MicroserviceTrait;
    /**
     *  @OA\Get(
     *     path="/api/users/stripe/{id}/payments-methods",
     *      operationId="list",
     *      tags={"Payment Methods"},
     *      summary="List all payments methods of a user",
     *      description="List all payments method.",
     *      @OA\Parameter(name="id",description="Customer id", required=true, in="query"),
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
     *     path="/api/users/stripe/{id}/payments-methods/{payment_method_id}",
     *      operationId="retrieve",
     *      tags={"Payment Methods"},
     *      summary="Retrieve a payments method",
     *      description="Retrieve a specific payments method by his ID.",
     *      @OA\Parameter(name="id",description="Customer id", required=true, in="query"),
     *      @OA\Parameter(name="payment_method_id",description="Payment method Id", required=true, in="query"),
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
     *  @OA\Get(
     *     path="/api/users/stripe/{id}/payments-methods/default-payments-method",
     *      operationId="defaultPaymentMethod",
     *      tags={"Payment Methods"},
     *      summary="Retrieve the default payments method",
     *      description="Retrieve the default payments method.",
     *      @OA\Parameter(name="id",description="Customer id", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function defaultPaymentMethod(Request $request): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }

    /**
     *  @OA\Get(
     *     path="/api/users/stripe/{id}/payments-methods/get-setup-intent",
     *      operationId="getSetupIntent",
     *      tags={"Payment Methods"},
     *      summary="Get setup Intent",
     *      description="Get setup Intent.",
     *      @OA\Parameter(name="id",description="Customer id", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function getSetupIntent(Request $request): JsonResponse|SetupIntent
    {
        return $this->uri($request, env("PAYMENT_API"));
    }

    /**
     *  @OA\Post(
     *     path="/api/users/stripe/{id}/payments-methods/confirm-setup-intent",
     *      operationId="confirmSetupIntent",
     *      tags={"Payment Methods"},
     *      summary="Confirm setup Intent",
     *      description="Confirm setup Intent.",
     *      @OA\Parameter(name="payment_method",description="Payment Method", required=true, in="query"),
     *      @OA\Parameter(name="seti",description="Seti", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function confirmSetupIntent(Request $request)
    {
        return $this->uri($request, env("PAYMENT_API"));
    }

    /**
     *  @OA\Post(
     *     path="/api/users/stripe/{id}/payments-methods",
     *      operationId="create",
     *      tags={"Payment Methods"},
     *      summary="Add a new payments method to a user",
     *      description="Add a new payments method.",
     *      @OA\Parameter(name="payment_method",description="Payment Method", required=true, in="query"),
     *      @OA\Parameter(name="id",description="Customer id ", required=true, in="query"),
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


    /**
     *  @OA\Patch(
     *     path="/api/users/stripe/{id}/payments-methods/{payment_method_id}",
     *      operationId="updateDefaultPaymentMethod",
     *      tags={"Payment Methods"},
     *      summary="Update the default payments method",
     *      description="Update the default payments method.",
     *      @OA\Parameter(name="payment_method_id",description="Payment Method Id ", required=true, in="query"),
     *      @OA\Parameter(name="id",description="Customer id ", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function updateDefaultPaymentMethod(Request $request): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }

    /**
     *  @OA\Delete(
     *     path="/api/users/stripe/{id}/payments-methods/{payment_method_id}",
     *      operationId="delete",
     *      tags={"Payment Methods"},
     *      summary="Delete a payments method",
     *      description="Delete a payments method only if the payments method is not the default payments method.",
     *      @OA\Parameter(name="payment_method_id",description="Payment Method Id ", required=true, in="query"),
     *      @OA\Parameter(name="id",description="Customer id ", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function delete(Request $request): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }
}
