<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use OpenApi\Annotations as OA;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExternalAccountController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Get(
     *     path="/api/stores/wallets/{id}/external-accounts",
     *      operationId="list",
     *      tags={"External Account"},
     *      summary="List all the bank accounts",
     *      description="List all the bank account of the connected account",
     *      @OA\Parameter(name="id",description="Wallet Id", required=true, in="query"),
     *      @OA\Parameter(name="object",description="Object type", required=true, in="query"),
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
     *     path="/api/stores/wallets/{id}/external-accounts/{external_account_id}",
     *      operationId="retrieve",
     *      tags={"External Account"},
     *      summary="Retrieve a bank account",
     *      description="Retrieve a specific bank account",
     *      @OA\Parameter(name="id",description="Wallet Id", required=true, in="query"),
     *      @OA\Parameter(name="external_account_id",description="Card ID or Bank account ID", required=true, in="query"),
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
     *     path="/api/stores/wallets/{id}/external-accounts",
     *      operationId="create",
     *      tags={"External Account"},
     *      summary="Create a new bank account",
     *      description="Create a new bank account for the connected account.",
     *      @OA\Parameter(name="id",description="Wallet Id", required=true, in="query"),
     *      @OA\Parameter(name="token",description="Card Token or Bank account Token", required=true, in="query"),
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
     *     path="/api/stores/wallets/{id}/external-accounts/{external_account_id}",
     *      operationId="update",
     *      tags={"External Account"},
     *      summary="Update a bank account",
     *      description="Update an existing bank account.",
     *      @OA\Parameter(name="id",description="Wallet Id", required=true, in="query"),
     *      @OA\Parameter(name="external_account_id",description="Card ID or Bank account ID", required=true, in="query"),
     *      @OA\Parameter(name="default_for_currency",description="For card and bank_account.When set to true, this becomes the default external account for its currency", required=false, in="query"),
     *      @OA\Parameter(name="account_holder_name",description="For band_account. The name of the person or business that owns the bank account", required=false, in="query"),
     *      @OA\Parameter(name="account_holder_type",description="For band_account. The type of entity that holds the account. This can be either individual or company.", required=false, in="query"),
     *      @OA\Parameter(name="address_city",description="For card. City/District/Suburb/Town/Village.", required=false, in="query"),
     *      @OA\Parameter(name="address_country",description="For card. Billing address country, if provided when creating card.", required=false, in="query"),
     *      @OA\Parameter(name="address_line1",description=" For card. Address line 1 (Street address/PO Box/Company name).", required=false, in="query"),
     *      @OA\Parameter(name="address_line2",description="For card. Address line 2 (Apartment/Suite/Unit/Building). ", required=false, in="query"),
     *      @OA\Parameter(name="address_state",description="For card. State/County/Province/Region.", required=false, in="query"),
     *      @OA\Parameter(name="address_zip",description="For card. ZIP or postal code.", required=false, in="query"),
     *      @OA\Parameter(name="exp_month",description="For card. Two digit number representing the card’s expiration month", required=false, in="query"),
     *      @OA\Parameter(name="exp_year",description="For card. Four digit number representing the card’s expiration year.", required=false, in="query"),
     *      @OA\Parameter(name="name",description="For card. Cardholder name.", required=false, in="query"),
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
     * @OA\Post(
     *     path="/api/stores/wallets/{id}/external-accounts/{external_account_id}",
     *      operationId="delete",
     *      tags={"External Account"},
     *      summary="Delete a bank account",
     *      description="Delete a bank account.",
     *      @OA\Parameter(name="id",description="Wallet Id", required=true, in="query"),
     *      @OA\Parameter(name="external_account_id",description="Card ID or Bank account ID", required=true, in="query"),
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

