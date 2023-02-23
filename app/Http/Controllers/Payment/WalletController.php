<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class WalletController extends Controller
{

    use MicroserviceTrait;
    /**
     * @OA\Get(
     *     path="/api/stores/wallets/{id}",
     *      operationId="retrieve",
     *      tags={"Wallets"},
     *      summary="Retrieve an account",
     *      description="Retrieve an account by his Id.",
     *      @OA\Parameter(name="id",description=" Wallet Id", required=true, in="query"),
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
     *     path="/api/stores/wallets/",
     *      operationId="create",
     *      tags={"Wallets"},
     *      summary="Create an account",
     *      description="Create a new account.",
     *      @OA\Parameter(name="account_token                        ",description="Account token Id                     ", required=true, in="query"),
     *      @OA\Parameter(name="mcc                                  ",description="MCC number who correspond to a domain", required=true, in="query"),
     *      @OA\Parameter(name="product_description                  ",description="Description of the product           ", required=true, in="query"),
     *      @OA\Parameter(name="country                              ",description="Country                              ", required=true, in="query"),
     *      @OA\Parameter(name="city                                 ",description="City                                 ", required=true, in="query"),
     *      @OA\Parameter(name="line1                                ",description="Line 1                               ", required=true, in="query"),
     *      @OA\Parameter(name="line2                                ",description="Line 2                               ", required=true, in="query"),
     *      @OA\Parameter(name="postal_code                          ",description="Postal Code                          ", required=true, in="query"),
     *      @OA\Parameter(name="state                                ",description="State                                ", required=true, in="query"),
     *      @OA\Parameter(name="name                                 ",description="Business Name                        ", required=true, in="query"),
     *      @OA\Parameter(name="registration_number                  ",description="Registration Number                  ", required=true, in="query"),
     *      @OA\Parameter(name="tax_id                               ",description="Tax Id                               ", required=true, in="query"),
     *      @OA\Parameter(name="vat_id                               ",description="Vat Id                               ", required=true, in="query"),
     *      @OA\Parameter(name="email                                ",description="Email                                ", required=true, in="query"),
     *      @OA\Parameter(name="phone                                ",description="Phone number                         ", required=true, in="query"),
     *      @OA\Parameter(name="url                                  ",description="Website Url                          ", required=true, in="query"),
     *      @OA\Parameter(name="bank_account_ownership_verification_1",description="File                                 ", required=false, in="query"),
     *      @OA\Parameter(name="bank_account_ownership_verification_2",description="File                                 ", required=false, in="query"),
     *      @OA\Parameter(name="company_license_1                    ",description="File                                 ", required=false, in="query"),
     *      @OA\Parameter(name="company_license_2                    ",description="File                                 ", required=false, in="query"),
     *      @OA\Parameter(name="company_memorandum_of_association_1  ",description="File                                 ", required=false, in="query"),
     *      @OA\Parameter(name="company_memorandum_of_association_2  ",description="File                                 ", required=false, in="query"),
     *      @OA\Parameter(name="company_ministerial_decree_1         ",description="File                                 ", required=false, in="query"),
     *      @OA\Parameter(name="company_ministerial_decree_2         ",description="File                                 ", required=false, in="query"),
     *      @OA\Parameter(name="company_registration_verification_1  ",description="File                                 ", required=false, in="query"),
     *      @OA\Parameter(name="company_registration_verification_2  ",description="File                                 ", required=false, in="query"),
     *      @OA\Parameter(name="company_tax_id_verification_1        ",description="File                                 ", required=false, in="query"),
     *      @OA\Parameter(name="company_tax_id_verification_2        ",description="File                                 ", required=false, in="query"),
     *      @OA\Parameter(name="external_account_country             ",description="Country account country              ", required=true, in="query"),
     *      @OA\Parameter(name="external_account_currency            ",description="Currency                             ", required=true, in="query"),
     *      @OA\Parameter(name="account_number                       ",description="Account Number                       ", required=true, in="query"),
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
     *     path="/api/stores/wallets/{id}",
     *      operationId="update",
     *      tags={"Wallets"},
     *      summary="Update an account",
     *      description="Update an account.",
     *      @OA\Parameter(name="id                              ",description="Wallet Id                             ", required=true, in="query"),
     *      @OA\Parameter(name="account_token                          ",description="Account Token Id                      ", required=true, in="query"),
     *      @OA\Parameter(name="mcc                                    ",description="MCC number who correspond to a domain ", required=true, in="query"),
     *      @OA\Parameter(name="product_description                    ",description="Description of the product            ", required=true, in="query"),
     *      @OA\Parameter(name="country                                ",description="Country                               ", required=true, in="query"),
     *      @OA\Parameter(name="city                                   ",description="City                                  ", required=true, in="query"),
     *      @OA\Parameter(name="line1                                  ",description="Line 1                                ", required=true, in="query"),
     *      @OA\Parameter(name="line2                                  ",description="Line 2                                ", required=true, in="query"),
     *      @OA\Parameter(name="postal_code                            ",description="Postal Code                           ", required=true, in="query"),
     *      @OA\Parameter(name="state                                  ",description="State                                 ", required=true, in="query"),
     *      @OA\Parameter(name="name                                   ",description="Business Name                         ", required=true, in="query"),
     *      @OA\Parameter(name="registration_number                    ",description="Registration Number                   ", required=true, in="query"),
     *      @OA\Parameter(name="tax_id                                 ",description="Tax Id                                ", required=true, in="query"),
     *      @OA\Parameter(name="vat_id                                 ",description="Vat Id                                ", required=true, in="query"),
     *      @OA\Parameter(name="email                                  ",description="Email                                 ", required=true, in="query"),
     *      @OA\Parameter(name="phone                                  ",description="Phone number                          ", required=true, in="query"),
     *      @OA\Parameter(name="url                                    ",description="Website Url                           ", required=true, in="query"),
     *      @OA\Parameter(name="bank_account_ownership_verification_1  ",description="File                                  ", required=false, in="query"),
     *      @OA\Parameter(name="bank_account_ownership_verification_2  ",description="File                                  ", required=false, in="query"),
     *      @OA\Parameter(name="company_license_1                      ",description="File                                  ", required=false, in="query"),
     *      @OA\Parameter(name="company_license_2                      ",description="File                                  ", required=false, in="query"),
     *      @OA\Parameter(name="company_memorandum_of_association_1    ",description="File                                  ", required=false, in="query"),
     *      @OA\Parameter(name="company_memorandum_of_association_2    ",description="File                                  ", required=false, in="query"),
     *      @OA\Parameter(name="company_ministerial_decree_1           ",description="File                                  ", required=false, in="query"),
     *      @OA\Parameter(name="company_ministerial_decree_2           ",description="File                                  ", required=false, in="query"),
     *      @OA\Parameter(name="company_registration_verification_1    ",description="File                                  ", required=false, in="query"),
     *      @OA\Parameter(name="company_registration_verification_2    ",description="File                                  ", required=false, in="query"),
     *      @OA\Parameter(name="company_tax_id_verification_1          ",description="File                                  ", required=false, in="query"),
     *      @OA\Parameter(name="company_tax_id_verification_2          ",description="File                                  ", required=false, in="query"),
     *      @OA\Parameter(name="external_account_country               ",description="Country account country               ", required=false, in="query"),
     *      @OA\Parameter(name="external_account_currency              ",description="Currency                              ", required=false, in="query"),
     *      @OA\Parameter(name="account_number                         ",description="Account Number                        ", required=true, in="query"),
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
     *     path="/api/stores/wallets/{id}",
     *      operationId="delete",
     *      tags={"Wallets"},
     *      summary="Delete a a connected account",
     *      description="Delete a connected account by his Id.",
     *      @OA\Parameter(name="id",description=" Wallet Id", required=true, in="query"),
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
