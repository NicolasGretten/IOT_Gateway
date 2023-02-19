<?php

namespace App\Http\Controllers;

use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class AdminController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Get(
     *      path="/api/admins/{id}",
     *      operationId="retrieve",
     *      tags={"Admins"},
     *      summary="Get admin information",
     *      description="Returns admin data",
     *      @OA\Parameter(name="id",description="Admin id",required=true,in="path"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Admin not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function retrieve(Request $request): JsonResponse
    {
        return $this->uri($request, env("ADMIN_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/admins",
     *      operationId="list",
     *      tags={"Admins"},
     *      summary="Get all admins information",
     *      description="Returns admin data",
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
        return $this->uri($request, env("ADMIN_API"));
    }

    /**
     * @OA\Post(
     *      path="/api/admins",
     *      operationId="create",
     *      tags={"Admins"},
     *      summary="Post a new admin",
     *      description="Create a new admin",
     *      @OA\Parameter(name="role", description="SUPER_ADMIN or ADMIN", required=true, in="query"),
     *      @OA\Parameter(name="account_id", description="Admin's account", required=true, in="query"),
     *      @OA\Response(response=201,description="Admin created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function create(Request $request): JsonResponse
    {
        return $this->uri($request, env("ADMIN_API"));
    }

    /**
     * @OA\Patch (
     *      path="/api/admins/{id}",
     *      operationId="update",
     *      tags={"Admins"},
     *      summary="Patch a admin",
     *      description="Update a admin",
     *      @OA\Parameter(name="id", description="Admin id", in="query"),
     *      @OA\Parameter(name="role", description="SUPER_ADMIN or ADMIN", in="query"),
     *      @OA\Response(response=200,description="Admin updated"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function update(Request $request): JsonResponse
    {
        return $this->uri($request, env("ADMIN_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/admins/{id}",
     *      operationId="delete",
     *      tags={"Admins"},
     *      summary="Delete a admin",
     *      description="Soft delete a admin",
     *      @OA\Parameter(name="id",description="Admin id",required=true,in="path"),
     *      @OA\Response(response=200,description="Admin deleted"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function delete(Request $request): JsonResponse
    {
        return $this->uri($request, env("ADMIN_API"));
    }
}
