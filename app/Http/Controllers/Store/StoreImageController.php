<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class StoreImageController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Post(
     *      path="/api/stores/{id}/images",
     *      operationId="addImage",
     *      tags={"Stores Images"},
     *      summary="Post a new store image",
     *      description="Create a image",
     *      @OA\Parameter(name="id", description="Store Id", required=true, in="query"),
     *      @OA\Parameter(name="image_id", description="Image Id", required=true, in="query"),
     *      @OA\Response(response=201,description="Image created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function addImage(Request $request): JsonResponse
    {
        return $this->uri($request, env("STORE_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/stores/{id}/images/{store_image_id}",
     *      operationId="removeImage",
     *      tags={"Stores Images"},
     *      summary="Delete a store image",
     *      description="Soft delete a store image",
     *      @OA\Parameter(
     *          name="id",
     *          description="Store id",
     *          required=true,
     *          in="query",
     *      ),
     *     @OA\Parameter(
     *          name="store_image_id",
     *          description="Image id",
     *          required=true,
     *          in="query",
     *      ),
     *      @OA\Response(response=200, description="Image deleted"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function removeImage(Request $request): JsonResponse
    {
        return $this->uri($request, env("STORE_API"));
    }
}
