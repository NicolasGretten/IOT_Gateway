<?php

namespace App\Http\Controllers;

use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Get(
     *      path="/api/users/{id}",
     *      operationId="retrieve",
     *      tags={"Users"},
     *      summary="Get user information",
     *      description="Returns user data",
     *      @OA\Parameter(name="id",description="User id",required=true,in="path"),
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
        return $this->uri($request, env("USER_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/users",
     *      operationId="list",
     *      tags={"Users"},
     *      summary="Get all users information",
     *      description="Returns user data",
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
        return $this->uri($request, env("USER_API"));
    }

    /**
     * @OA\Post(
     *      path="/api/users",
     *      operationId="create",
     *      tags={"Users"},
     *      summary="Post a new user",
     *      description="Create a new user",
     *      @OA\Parameter(name="addressId", description="User's address", required=true, in="query"),
     *      @OA\Parameter(name="storeId", description="User's store", required=true, in="query"),
     *      @OA\Parameter(name="accountId", description="User's account", required=true, in="query"),
     *      @OA\Response(response=201,description="Account created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function create(Request $request): JsonResponse
    {
        return $this->uri($request, env("USER_API"));
    }

    /**
     * @OA\Patch (
     *      path="/api/users/{id}",
     *      operationId="update",
     *      tags={"Users"},
     *      summary="Patch a user",
     *      description="Update a user",
     *      @OA\Parameter(name="addressId", description="First name", in="query"),
     *      @OA\Parameter(name="storeId", description="Last name", in="query"),
     *      @OA\Parameter(name="accountId", description="gender", in="query"),
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
        return $this->uri($request, env("USER_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/users/{id}",
     *      operationId="delete",
     *      tags={"Users"},
     *      summary="Delete a user",
     *      description="Soft delete a user",
     *      @OA\Parameter(
     *          name="id",
     *          description="Account id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="String"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Account deleted"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function delete(Request $request): JsonResponse
    {
        return $this->uri($request, env("USER_API"));
    }
}
