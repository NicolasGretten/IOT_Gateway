<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class UserStripeController extends Controller
{
    use MicroserviceTrait;
    /**
     * @OA\Get(
     *     path="/api/users/stripe/{id}",
     *      operationId="retrieve",
     *      tags={"Users Stripe"},
     *      summary="Retrieve a UserStripe",
     *      description="Retrieve a user by his ID",
     *      @OA\Parameter(name="id",description="User id", required=true, in="query"),
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
     * @OA\Post(
     *     path="/api/users/stripe/",
     *      operationId="create",
     *      tags={"Users Stripe"},
     *      summary="Create a Stripe User",
     *      description="Create a Stripe User",
     *      @OA\Parameter(name="email",description="Email", required=true, in="query"),
     *      @OA\Parameter(name="city",description="City", required=false, in="query"),
     *      @OA\Parameter(name="country",description="Country/ Two letter caps ", required=false, in="query"),
     *      @OA\Parameter(name="line1",description="Address line 1", required=false, in="query"),
     *      @OA\Parameter(name="line2",description="Address line 2", required=false, in="query"),
     *      @OA\Parameter(name="postal_code",description="Postal code ", required=false, in="query"),
     *      @OA\Parameter(name="state",description="State ", required=false, in="query"),
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
     *     path="/api/users/stripe/{id}",
     *      operationId="update",
     *      tags={"Users Stripe"},
     *      summary="Update a user",
     *      description="Update a user",
     *      @OA\Parameter(name="id",description="UserStripe id ", required=true, in="query"),
     *      @OA\Parameter(name="email",description="Email", required=true, in="query"),
     *      @OA\Parameter(name="city",description="City", required=false, in="query"),
     *      @OA\Parameter(name="country",description="Country/ Two letter caps ", required=false, in="query"),
     *      @OA\Parameter(name="line1",description="Address line 1", required=false, in="query"),
     *      @OA\Parameter(name="line2",description="Address line 2", required=false, in="query"),
     *      @OA\Parameter(name="postal_code",description="Postal code ", required=false, in="query"),
     *      @OA\Parameter(name="state",description="State ", required=false, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function update(Request $request): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }

    /**
     * @OA\Delete(
     *     path="/api/users/stripe/{id}",
     *      operationId="delete",
     *      tags={"Users Stripe"},
     *      summary="Delete a user",
     *      description="Delete a user",
     *      @OA\Parameter(name="id",description="UserStripe id ", required=true, in="query"),
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
     * @OA\Get(
     *     path="/api/users/stripe/{id}/check-payment-account",
     *      operationId="checkPaymentAccount",
     *      tags={"Users Stripe"},
     *      summary="Check payment account id",
     *      description="Check payment account id",
     *      @OA\Parameter(name="id",description="UserStripe id ", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function checkPaymentAccount(Request $request): SetupIntent|JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }
}
