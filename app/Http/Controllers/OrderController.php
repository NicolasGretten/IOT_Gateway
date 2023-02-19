<?php

namespace App\Http\Controllers;

use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class OrderController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Get(
     *      path="/api/orders/{id}",
     *      operationId="retrieve",
     *      tags={"Orders"},
     *      summary="Get order information",
     *      description="Returns order data",
     *      @OA\Parameter(name="id",description="Order id", required=true, in="query"),
     *      @OA\Parameter(name="user_id",description="User Id", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Order not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function retrieve(Request $request): JsonResponse
    {
        return $this->uri($request, env("ORDER_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/orders",
     *      operationId="list",
     *      tags={"Orders"},
     *      summary="Get all orders information",
     *      description="Returns order data, ADMIN Route",
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
        return $this->uri($request, env("ORDER_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/orders/users/{user_id}",
     *      operationId="listUserId",
     *      tags={"Orders"},
     *      summary="Get all orders information by Users",
     *      description="Returns order data",
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
        return $this->uri($request, env("ORDER_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/orders/stores/{store_id}",
     *      operationId="listStoreId",
     *      tags={"Orders"},
     *      summary="Get all orders information by store",
     *      description="Returns order data",
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
        return $this->uri($request, env("ORDER_API"));
    }

    /**
     * @OA\Post(
     *      path="/api/orders",
     *      operationId="create",
     *      tags={"Orders"},
     *      summary="Post a new order",
     *      description="Create a order",
     *      @OA\Parameter(name="store_id", description="Store Id", required=true, in="query"),
     *      @OA\Parameter(name="store_slot_id", description="Store slot Id", required=false, in="query"),
     *      @OA\Parameter(name="user_id", description="User Id", required=true, in="query"),
     *      @OA\Parameter(name="cart_id", description="Cart Id", required=true, in="query"),
     *      @OA\Response(response=201,description="Order created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function create(Request $request): JsonResponse
    {
        return $this->uri($request, env("ORDER_API"));
    }

    /**
     * @OA\Patch  (
     *      path="/api/orders/{id}",
     *      operationId="update",
     *      tags={"Orders"},
     *      summary="Update a order",
     *      description="Update a order",
     *      @OA\Parameter(name="id",description="Order id",required=true,in="query",),
     *      @OA\Parameter(name="comment",description="Comment",required=false,in="query"),
     *      @OA\Parameter(name="store_slot_id", description="Store slot Id", required=false, in="query"),
     *      @OA\Parameter(name="state",description="State of order",required=false,in="query"),
     *      @OA\Parameter(name="available_at",description="State of order",required=false,in="query"),
     *      @OA\Response(response=200,description="Order Updated"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function update(Request $request):JsonResponse
    {
        return $this->uri($request, env("ORDER_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/orders/{id}",
     *      operationId="delete",
     *      tags={"Orders"},
     *      summary="Delete a order",
     *      description="Soft delete a order",
     *      @OA\Parameter(name="id",description="Order id",required=true,in="query"),
     *      @OA\Response(response=200,description="Order deleted"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function delete(Request $request):JsonResponse
    {
        return $this->uri($request, env("ORDER_API"));
    }
}
