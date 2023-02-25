<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class SubscriptionController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Get(
     *     path="/api/users/{id}/subscriptions",
     *      operationId="create",
     *      tags={"Subscriptions"},
     *      summary="Create a Subscription",
     *      description="Create a Subscription",
     *      @OA\Parameter(name="id",description="User id", required=true, in="query"),
     *      @OA\Parameter(name="plan",description="Subscription plan: default", required=true, in="query"),
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
     * @OA\Patch(
     *     path="/api/users/{id}/subscriptions",
     *      operationId="update",
     *      tags={"Subscriptions"},
     *      summary="Update a Subscription",
     *      description="Update a Subscription",
     *      @OA\Parameter(name="id",description="User id", required=true, in="query"),
     *      @OA\Parameter(name="plan",description="Subscription plan", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function update(Request $request)
    {
        return $this->uri($request, env("PAYMENT_API"));
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}/subscriptions",
     *      operationId="delete",
     *      tags={"Subscriptions"},
     *      summary="Delete a Subscription",
     *      description="Delete a Subscription",
     *      @OA\Parameter(name="id",description="User id", required=true, in="query"),
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

    /**
     * @OA\Patch(
     *     path="/api/users/{id}/subscriptions/resume",
     *      operationId="resume",
     *      tags={"Subscriptions"},
     *      summary="Resume a Subscription",
     *      description="Resume a Subscription",
     *      @OA\Parameter(name="id",description="User id", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function resume(Request $request): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }

    /**
     * @OA\Patch(
     *     path="/api/users/{id}/subscriptions/quantity",
     *      operationId="quantity",
     *      tags={"Subscriptions"},
     *      summary="Update quantity of a Subscription",
     *      description="Update quantity of a Subscription",
     *      @OA\Parameter(name="id",description="User id", required=true, in="query"),
     *      @OA\Parameter(name="quantity",description="Quantity of subscription", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function quantity(Request $request): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }
}
