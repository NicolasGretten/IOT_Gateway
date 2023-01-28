<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class StoreClosingController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Post(
     *      path="/api/stores/{id}/closings",
     *      operationId="addClosing",
     *      tags={"Stores Closings"},
     *      summary="Post a new store closing",
     *      description="Create a closing",
     *      @OA\Parameter(name="id", description="Store Id", required=true, in="query"),
     *      @OA\Parameter(name="from", description="From", required=true, in="query"),
     *      @OA\Parameter(name="to", description="To", required=true, in="query"),
     *      @OA\Response(response=201,description="Closing created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function addClosing(Request $request): JsonResponse
    {
        return $this->uri($request, env("STORE_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/stores/{id}/closings/{closing_id}",
     *      operationId="removeClosing",
     *      tags={"Stores Closings"},
     *      summary="Delete a store closing",
     *      description="Soft delete a closing",
     *      @OA\Parameter(
     *          name="id",
     *          description="Store id",
     *          required=true,
     *          in="query",
     *      ),
     *     @OA\Parameter(
     *          name="closing_id",
     *          description="Closing id",
     *          required=true,
     *          in="query",
     *      ),
     *      @OA\Response(response=200, description="Closing deleted"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function removeClosing(Request $request): JsonResponse
    {
        return $this->uri($request, env("STORE_API"));
    }
}
