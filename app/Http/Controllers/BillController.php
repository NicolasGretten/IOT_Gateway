<?php

namespace App\Http\Controllers;

use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class BillController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Get(
     *      path="/api/bills/{id}",
     *      operationId="retrieve",
     *      tags={"Bills"},
     *      summary="Get bill information",
     *      description="Returns bill data",
     *      @OA\Parameter(name="id",description="Bill id", required=true, in="query"),
     *      @OA\Parameter(name="user_id",description="User Id", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Bill not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function retrieve(Request $request): JsonResponse
    {
        return $this->uri($request, env("BILL_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/bills/carts/{cart_id}",
     *      operationId="retrieveByCartId",
     *      tags={"Bills"},
     *      summary="Get bill information by cart",
     *      description="Returns bill data",
     *      @OA\Parameter(name="cart_id",description="Cart id", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Bill not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function retrieveByCartId(Request $request): JsonResponse
    {
        return $this->uri($request, env("BILL_API"));
    }


    /**
     * @OA\Get(
     *      path="/api/bills",
     *      operationId="list",
     *      tags={"Bills"},
     *      summary="Get all bills information",
     *      description="Returns bill data, ADMIN Route",
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
        return $this->uri($request, env("BILL_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/bills/users/{user_id}",
     *      operationId="listUserId",
     *      tags={"Bills"},
     *      summary="Get all bills information by Users",
     *      description="Returns bill data",
     *      @OA\Parameter(name="user_id",description="User Id", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function listUserId(Request $request): JsonResponse
    {
        return $this->uri($request, env("BILL_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/bills/stores/{store_id}",
     *      operationId="listStoreId",
     *      tags={"Bills"},
     *      summary="Get all bills information by store",
     *      description="Returns bill data",
     *      @OA\Parameter(name="store_id",description="Store Id", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function listStoreId(Request $request): JsonResponse
    {
        return $this->uri($request, env("BILL_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/bills/{id}",
     *      operationId="delete",
     *      tags={"Bills"},
     *      summary="Delete a bill",
     *      description="Soft delete a bill",
     *      @OA\Parameter(name="id",description="Bill id",required=true,in="query"),
     *      @OA\Response(response=200,description="Bill deleted"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function delete(Request $request):JsonResponse
    {
        return $this->uri($request, env("BILL_API"));
    }

    /**
     * @OA\Get  (
     *      path="/api/bills/{id}/pdf",
     *      operationId="generatePdf",
     *      tags={"Bills"},
     *      summary="generate a PDF",
     *      description="Generate the bill in PDF",
     *      @OA\Parameter(name="id",description="Bill id",required=true,in="query"),
     *      @OA\Response(response=200,description="Bill deleted"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function generatePdf(Request $request): JsonResponse | Response
    {
        return $this->uri($request, env("BILL_API"));
    }
}
