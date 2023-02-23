<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;


class TokenController extends Controller
{
    use MicroserviceTrait;

    /**
     *  @OA\Get(
     *     path="/api/tokens/{token_id}",
     *      operationId="retrieve",
     *      tags={"Tokens"},
     *      summary="Retrieve a token",
     *      description="Retrieve a token by his Id.",
     *      @OA\Parameter(name="token_id",description="Token ID", required=true, in="query"),
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
     *     path="/api/tokens/account",
     *      operationId="accountToken",
     *      tags={"Tokens"},
     *      summary="Create an account token",
     *      description="Create an account token",
     *      @OA\Parameter(name="tos",description="Terms of service", required=true, in="query"),
     *      @OA\Parameter(name="city",description="City", required=false, in="query"),
     *      @OA\Parameter(name="country",description="Country/ Two letter caps", required=false, in="query"),
     *      @OA\Parameter(name="line1",description="Address line 1", required=false, in="query"),
     *      @OA\Parameter(name="line2",description="Address line 2", required=false, in="query"),
     *      @OA\Parameter(name="postal_code",description="Postal code", required=false, in="query"),
     *      @OA\Parameter(name="state",description="State", required=false, in="query"),
     *      @OA\Parameter(name="name",description="Name", required=false, in="query"),
     *      @OA\Parameter(name="phone",description="Phone number", required=false, in="query"),
     *      @OA\Parameter(name="registration_number",description="Registration Number", required=false, in="query"),
     *      @OA\Parameter(name="tax_id",description="Tax Number", required=false, in="query"),
     *      @OA\Parameter(name="vat_id",description=" VAt Number", required=false, in="query"),
     *      @OA\Parameter(name="directors_provided",description="If director have been provided", required=false, in="query"),
     *      @OA\Parameter(name="executives_provided",description="If director have been provided ", required=false, in="query"),
     *      @OA\Parameter(name="owners_provided",description="If director have been provided", required=false, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function accountToken(Request $request): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }

    /**
     *  @OA\Post(
     *     path="/api/tokens/person",
     *      operationId="personToken",
     *      tags={"Tokens"},
     *      summary="Create a person token",
     *      description="Create a person token.",
     *      @OA\Parameter(name="email",description="Email", required=true, in="query"),
     *      @OA\Parameter(name="first_name",description="First Name", required=true, in="query"),
     *      @OA\Parameter(name="last_name",description="Last Name", required=true, in="query"),
     *      @OA\Parameter(name="maiden_name",description="Maiden Name", required=false, in="query"),
     *      @OA\Parameter(name="gender",description="Gender", required=false, in="query"),
     *      @OA\Parameter(name="nationality",description="Nationality / 2 Letter caps ", required=true, in="query"),
     *      @OA\Parameter(name="phone",description="Phone number", required=true, in="query"),
     *      @OA\Parameter(name="director",description="If director of the company", required=true, in="query"),
     *      @OA\Parameter(name="executive",description="If executive of the company", required=true, in="query"),
     *      @OA\Parameter(name="owner",description="If owner of the company", required=true, in="query"),
     *      @OA\Parameter(name="percent_ownership",description="Percent ownership of the company if owner", required=true, in="query"),
     *      @OA\Parameter(name="representative",description="If representative of the company ", required=true, in="query"),
     *      @OA\Parameter(name="title",description="Title in the company", required=true, in="query"),
     *      @OA\Parameter(name="day",description="Day of birth", required=true, in="query"),
     *      @OA\Parameter(name="month",description="Month of birth ", required=true, in="query"),
     *      @OA\Parameter(name="year",description="Year of birth  ", required=true, in="query"),
     *      @OA\Parameter(name="city",description="City", required=true, in="query"),
     *      @OA\Parameter(name="country",description="Country ", required=true, in="query"),
     *      @OA\Parameter(name="line1",description="Address line 1", required=true, in="query"),
     *      @OA\Parameter(name="line2",description="Address line 2", required=false, in="query"),
     *      @OA\Parameter(name="postal_code",description="Postal code ", required=true, in="query"),
     *      @OA\Parameter(name="state",description="State", required=true, in="query"),
     *      @OA\Parameter(name="additional_document_back",description="Additional document back", required=false, in="query"),
     *      @OA\Parameter(name="additional_document_front",description="Additional document front", required=false, in="query"),
     *      @OA\Parameter(name="document_back ",description="Document back", required=false, in="query"),
     *      @OA\Parameter(name="document_front",description="  Document front", required=false, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function personToken(Request $request): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }

    /**
     *  @OA\Post(
     *     path="/api/tokens/bank-account",
     *      operationId="bankAccountToken",
     *      tags={"Tokens"},
     *      summary="Create a bank account token",
     *      description="Create a bank account token.",
     *      @OA\Parameter(name="country            ",description="The country in which the bank account is located.                                                 ", required=true , in="query"),
     *      @OA\Parameter(name="currency           ",description="The currency the bank account is in. This must be a country/currency pairing that Stripe supports.", required=true , in="query"),
     *      @OA\Parameter(name="account_holder_name",description="The name of the person or business that owns the bank account.                                    ", required=false         , in="query"),
     *      @OA\Parameter(name="account_holder_type",description="The type of entity that holds the account. This can be either individual or company.              ", required=false         , in="query"),
     *      @OA\Parameter(name="account_number     ",description="The account number for the bank account, in string form. Must be a checking account.              ", required=true , in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function bankAccountToken(Request $request): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }

    /**
     *  @OA\Post(
     *     path="/api/tokens/card",
     *      operationId="cardToken",
     *      tags={"Tokens"},
     *      summary="Create a card token",
     *      description="Create a card token.",
     *      @OA\Parameter(name="exp_month      ",description="Two-digit number representing the card's expiration month.                                                                           ", required=true , in="query"),
     *      @OA\Parameter(name="exp_year       ",description="Two- or four-digit number representing the card's expiration year.                                                                   ", required=true , in="query"),
     *      @OA\Parameter(name="number         ",description="The card number, as a string without any separators.                                                                                 ", required=true , in="query"),
     *      @OA\Parameter(name="currency       ",description="The currency.                                                                                                                        ", required=false, in="query"),
     *      @OA\Parameter(name="cvc            ",description="Card security code. Highly recommended to always include this value, but it's required only for accounts based in European countries.", required=true , in="query"),
     *      @OA\Parameter(name="name           ",description="Cardholder's full name.                                                                                                              ", required=false, in="query"),
     *      @OA\Parameter(name="address_line1  ",description="Address line 1 (Street address / PO Box / Company name).                                                                             ", required=false, in="query"),
     *      @OA\Parameter(name="address_line2  ",description="Address line 2 (Apartment / Suite / Unit / Building).                                                                                ", required=false, in="query"),
     *      @OA\Parameter(name="address_city   ",description="City / District / Suburb / Town / Village.                                                                                           ", required=false, in="query"),
     *      @OA\Parameter(name="address_state  ",description="State / County / Province / Region.                                                                                                  ", required=false, in="query"),
     *      @OA\Parameter(name="address_zip    ",description="ZIP or postal code.                                                                                                                  ", required=false, in="query"),
     *      @OA\Parameter(name="address_country",description="Billing address country, if provided.                                                                                                ", required=false, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Payment not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function cardToken(Request $request): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }
}
