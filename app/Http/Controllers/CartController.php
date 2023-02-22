<?php

namespace App\Http\Controllers;

use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class CartController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Get(
     *      path="/api/carts/{id}",
     *      operationId="retrieve",
     *      tags={"Carts"},
     *      summary="Get cart information",
     *      description="Returns cart data",
     *      @OA\Parameter(name="id",description="Cart id", required=true, in="query"),
     *      @OA\Parameter(name="user_id",description="User Id", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Cart not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function retrieve(Request $request): JsonResponse
    {
        return $this->uri($request, env("CART_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/carts",
     *      operationId="list",
     *      tags={"Carts"},
     *      summary="Get all carts information",
     *      description="Returns cart data, ADMIN Route",
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
        return $this->uri($request, env("CART_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/carts/users/{user_id}",
     *      operationId="listUserId",
     *      tags={"Carts"},
     *      summary="Get all carts information by Users",
     *      description="Returns cart data",
     *      @OA\Parameter(name="user_id",description="User Id", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function listUserId(Request $request): JsonResponse
    {
        return $this->uri($request, env("CART_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/carts/stores/{store_id}",
     *      operationId="listStoreId",
     *      tags={"Carts"},
     *      summary="Get all carts information by store",
     *      description="Returns cart data",
     *      @OA\Parameter(name="store_id",description="Store Id", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function listStoreId(Request $request): JsonResponse
    {
        return $this->uri($request, env("CART_API"));
    }

    /**
     * @OA\Post(
     *      path="/api/carts",
     *      operationId="create",
     *      tags={"Carts"},
     *      summary="Post a new cart",
     *      description="Create a cart",
     *      @OA\Parameter(name="store_id", description="Store Id", required=true, in="query"),
     *      @OA\Parameter(name="user_id", description="User Id", required=true, in="query"),
     *      @OA\Response(response=201,description="Cart created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function create(Request $request): JsonResponse
    {
        return $this->uri($request, env("CART_API"));
    }

    /**
     * @OA\Patch  (
     *      path="/api/carts/{id}",
     *      operationId="update",
     *      tags={"Carts"},
     *      summary="Update a cart",
     *      description="Update a cart",
     *      @OA\Parameter(name="id",description="Cart id",required=true,in="query",),
     *      @OA\Parameter(name="payment_method",description="Payment method",required=false,in="query"),
     *      @OA\Parameter(name="status",description="PENDING, CONFIRM, REFUND, ABORT",required=false,in="query"),
     *      @OA\Parameter(name="refund_at",description="Refund",required=false,in="query"),
     *      @OA\Parameter(name="paid_at",description="PAaid date",required=false,in="query"),
     *      @OA\Parameter(name="capture_at",description="Capture date",required=false,in="query"),
     *      @OA\Response(response=200,description="Cart Updated"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function update(Request $request):JsonResponse
    {
        return $this->uri($request, env("CART_API"));
    }

    /**
     * @OA\Patch  (
     *      path="/api/carts/{id}/confirm",
     *      operationId="confirm",
     *      tags={"Carts"},
     *      summary="Confirm a cart",
     *      description="Confirm a cart",
     *      @OA\Parameter(name="id",description="Cart id",required=true,in="query",),
     *      @OA\Response(response=200,description="Cart Confirmed"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function confirm(Request $request):JsonResponse
    {
        return $this->uri($request, env("CART_API"));
    }

    /**
     * @OA\Patch  (
     *      path="/api/carts/{id}/refund",
     *      operationId="refund",
     *      tags={"Carts"},
     *      summary="Refund a cart",
     *      description="Refund a cart",
     *      @OA\Parameter(name="id",description="Cart id",required=true,in="query",),
     *      @OA\Response(response=200,description="Cart Confirmed"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function refund(Request $request):JsonResponse
    {
        return $this->uri($request, env("CART_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/carts/{id}",
     *      operationId="delete",
     *      tags={"Carts"},
     *      summary="Delete a cart",
     *      description="Soft delete a cart",
     *      @OA\Parameter(name="id",description="Cart id",required=true,in="query"),
     *      @OA\Response(response=200,description="Cart deleted"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function delete(Request $request):JsonResponse
    {
        return $this->uri($request, env("CART_API"));
    }

    /**
     * @OA\Patch  (
     *      path="/api/carts/{id}/contents/{cart_content_id}",
     *      operationId="updateContent",
     *      tags={"Carts Contents"},
     *      summary="update a cart content",
     *      description="Update a cart content",
     *      @OA\Parameter(name="id",description="Cart id",required=true,in="query"),
     *      @OA\Parameter(name="cart_content_id",description="Cart content id",required=true,in="query"),
     *      @OA\Parameter(name="quantity",description="Quantity",required=false,in="query"),
     *      @OA\Response(response=200, description="Cart content deleted"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function updateContent(Request $request): JsonResponse
    {
        return $this->uri($request, env("CART_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/carts/{id}/contents/{cart_content_id}",
     *      operationId="removeContent",
     *      tags={"Carts Contents"},
     *      summary="Delete a cart content",
     *      description="Soft delete a content",
     *      @OA\Parameter(name="id",description="Cart id",required=true,in="query"),
     *      @OA\Parameter(name="cart_content_id",description="Cart content id",required=true,in="query"),
     *      @OA\Response(response=200, description="Cart content deleted"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function removeContent(Request $request): JsonResponse
    {
        return $this->uri($request, env("CART_API"));
    }
}
