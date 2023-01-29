<?php

namespace App\Http\Controllers;

use App\Traits\IdTrait;
use App\Traits\MicroserviceTrait;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\JsonEncodingException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use OpenApi\Annotations as OA;
use PDOException;

class EmployeeController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Get(
     *      path="/api/employees/{id}",
     *      operationId="retrieve",
     *      tags={"Employees"},
     *      summary="Get employee information",
     *      description="Returns employee data",
     *      @OA\Parameter(name="id",description="Employee id",required=true,in="path"),
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
        return $this->uri($request, env("EMPLOYEE_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/employees",
     *      operationId="list",
     *      tags={"Employees"},
     *      summary="Get all employees information",
     *      description="Returns employee data",
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
        return $this->uri($request, env("EMPLOYEE_API"));
    }

    /**
     * @OA\Post(
     *      path="/api/employees",
     *      operationId="create",
     *      tags={"Employees"},
     *      summary="Post a new employee",
     *      description="Create a new employee",
     *      @OA\Parameter(name="role", description="Employee's role", required=true, in="query"),
     *      @OA\Parameter(name="store_id", description="Employee's store", required=true, in="query"),
     *      @OA\Parameter(name="account_id", description="Employee's account", required=true, in="query"),
     *      @OA\Response(response=201,description="Employee created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function create(Request $request): JsonResponse
    {
        return $this->uri($request, env("EMPLOYEE_API"));
    }

    /**
     * @OA\Patch (
     *      path="/api/employees/{id}",
     *      operationId="update",
     *      tags={"Employees"},
     *      summary="Patch a employee",
     *      description="Update a employee",
     *      @OA\Parameter(name="id", description="Employee id", in="query"),
     *      @OA\Parameter(name="role", description="Role", in="query"),
     *      @OA\Response(
     *          response=200,
     *          description="Employee updated"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function update(Request $request): JsonResponse
    {
        return $this->uri($request, env("EMPLOYEE_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/employees/{id}",
     *      operationId="delete",
     *      tags={"Employees"},
     *      summary="Delete a employee",
     *      description="Soft delete a employee",
     *      @OA\Parameter(
     *          name="id",
     *          description="Employee id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="String"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Employee deleted"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function delete(Request $request): JsonResponse
    {
        return $this->uri($request, env("EMPLOYEE_API"));
    }
}
