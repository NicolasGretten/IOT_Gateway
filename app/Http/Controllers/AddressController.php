<?php

namespace App\Http\Controllers;

use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class AddressController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Get(
     *      path="/api/addresses/{id}",
     *      operationId="retrieve",
     *      tags={"Addresses"},
     *      summary="Get address information",
     *      description="Returns address data",
     *      @OA\Parameter(name="id",description="Address id",required=true,in="path"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Account not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function retrieve(Request $request): JsonResponse
    {
        return $this->uri($request, env("ADDRESS_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/addresses",
     *      operationId="list",
     *      tags={"Addresses"},
     *      summary="Get all addresses information",
     *      description="Returns address data",
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function list(Request $request): JsonResponse
    {
        return $this->uri($request, env("ADDRESS_API"));
    }

    /**
     * @OA\Post(
     *      path="/api/addresses",
     *      operationId="create",
     *      tags={"Addresses"},
     *      summary="Post a new address",
     *      description="Create a new address",
     *      @OA\Parameter(name="title", description="Address title", required=true, in="query"),
     *      @OA\Parameter(name="address_line_1", description="Address line 1", required=true, in="query"),
     *      @OA\Parameter(name="address_line_2", description="Address line 2", in="query"),
     *      @OA\Parameter(name="zip_code", description="Zip code", required=true, in="query"),
     *      @OA\Parameter(name="city", description="City", required=true, in="query"),
     *      @OA\Parameter(name="country", description="Address country", required=true, in="query"),
     *      @OA\Response(response=201,description="Account created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function create(Request $request): JsonResponse
    {
        return $this->uri($request, env("ADDRESS_API"));
    }

    /**
     * @OA\Patch (
     *      path="/api/addresses/{id}",
     *      operationId="update",
     *      tags={"Addresses"},
     *      summary="Patch a address",
     *      description="Update an address",
     *      @OA\Parameter(name="id",description="Address id",required=true,in="path"),
     *      @OA\Parameter(name="title", description="Address title", in="query"),
     *      @OA\Parameter(name="address_line_1", description="Address line 1", in="query"),
     *      @OA\Parameter(name="address_line_2", description="Address line 2", in="query"),
     *      @OA\Parameter(name="zip_code", description="Zip code", in="query"),
     *      @OA\Parameter(name="city", description="City", in="query"),
     *      @OA\Parameter(name="country", description="Address country", in="query"),
     *      @OA\Response(
     *          response=200,
     *          description="Account updated"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function update(Request $request): JsonResponse
    {
        return $this->uri($request, env("ADDRESS_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/addresses/{id}",
     *      operationId="delete",
     *      tags={"Addresses"},
     *      summary="Delete a address",
     *      description="Soft delete a address",
     *      @OA\Parameter(name="id",description="Address id",required=true,in="path"),
     *      @OA\Response(response=200,description="Account deleted"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function delete(Request $request): JsonResponse
    {
        return $this->uri($request, env("ADDRESS_API"));
    }
}
