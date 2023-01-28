<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class StoreController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Get(
     *      path="/api/stores/{id}",
     *      operationId="retrieve",
     *      tags={"Stores"},
     *      summary="Get store information",
     *      description="Returns store data",
     *      @OA\Parameter(name="id",description="Store id", required=true, in="query"),
     *      @OA\Parameter(name="locale",description="Locale", required=false, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Store not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function retrieve(Request $request): JsonResponse
    {
        return $this->uri($request, env("STORE_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/stores",
     *      operationId="list",
     *      tags={"Stores"},
     *      summary="Get all stores information",
     *      description="Returns stores data",
     *      @OA\Parameter(name="locale",description="Locale", required=false, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function list(Request $request): JsonResponse
    {
        return $this->uri($request, env("STORE_API"));
    }

    /**
     * @OA\Post(
     *      path="/api/stores",
     *      operationId="create",
     *      tags={"Stores"},
     *      summary="Post a new store",
     *      description="Create a store",
     *      @OA\Parameter(name="account_id", description="Account Id", required=true, in="query"),
     *      @OA\Parameter(name="name", description="Store name", required=true, in="query"),
     *      @OA\Parameter(name="business_name", description="Store business name", required=true, in="query"),
     *      @OA\Parameter(name="address_id", description="Address Id", required=true, in="query"),
     *      @OA\Parameter(name="phone", description="Store phone", required=true, in="query"),
     *      @OA\Parameter(name="email", description="Store email", required=true, in="query"),
     *      @OA\Parameter(name="type", description="Store type", required=true, in="query"),
     *      @OA\Parameter(name="openings", description="Store openings", required=false, in="query"),
     *      @OA\Parameter(name="primary_color", description="Store primary color", required=false, in="query"),
     *      @OA\Parameter(name="secondary_color", description="Store secondary color", required=false, in="query"),
     *      @OA\Parameter(name="logo", description="Store logo", required=false, in="query"),
     *      @OA\Parameter(name="locale", description="Locale", required=true, in="query"),
     *      @OA\Parameter(name="description", description="Description", required=true, in="query"),
     *      @OA\Response(response=201,description="Store created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function create(Request $request): JsonResponse
    {
        return $this->uri($request, env("STORE_API"));
    }

    /**
     * @OA\Patch (
     *      path="/api/stores/{id}",
     *      operationId="update",
     *      tags={"Stores"},
     *      summary="Patch a store",
     *      description="Update a store",
     *      @OA\Parameter(name="id",description="Store id", required=true, in="query"),
     *      @OA\Parameter(name="account_id", description="Account Id", required=false, in="query"),
     *      @OA\Parameter(name="name", description="Store name", required=false, in="query"),
     *      @OA\Parameter(name="business_name", description="Store business Name", required=false, in="query"),
     *      @OA\Parameter(name="address_id", description="Address Id", required=false, in="query"),
     *      @OA\Parameter(name="phone", description="Store phone", required=false, in="query"),
     *      @OA\Parameter(name="email", description="Store email", required=false, in="query"),
     *      @OA\Parameter(name="type", description="Store type", required=false, in="query"),
     *      @OA\Parameter(name="openings", description="Store openings", required=false, in="query"),
     *      @OA\Parameter(name="primary_color", description="Store primary color", required=false, in="query"),
     *      @OA\Parameter(name="secondary_color", description="Store secondary color", required=false, in="query"),
     *      @OA\Parameter(name="logo", description="Store logo", required=false, in="query"),
     *      @OA\Response(
     *          response=200,
     *          description="Store updated"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function update(Request $request): JsonResponse
    {
        return $this->uri($request, env("STORE_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/stores/{id}",
     *      operationId="delete",
     *      tags={"Stores"},
     *      summary="Delete a store",
     *      description="Soft delete a store",
     *      @OA\Parameter(
     *          name="id",
     *          description="Store id",
     *          required=true,
     *          in="query",
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Store deleted"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function delete(Request $request): JsonResponse
    {
        return $this->uri($request, env("STORE_API"));
    }
}
