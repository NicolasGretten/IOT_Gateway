<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class CategoryController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Get(
     *      path="/api/categories/{id}",
     *      operationId="retrieve",
     *      tags={"Categories"},
     *      summary="Get category information",
     *      description="Returns category data",
     *      @OA\Parameter(name="locale",description="Locale", required=false, in="query"),
     *      @OA\Parameter(name="id",description="Category id", required=true, in="query"),
     *      @OA\Parameter(name="store_id",description="Store Id", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Category not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function retrieve(Request $request): JsonResponse
    {
        return $this->uri($request, env("PRODUCT_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/categories",
     *      operationId="list",
     *      tags={"Categories"},
     *      summary="Get all categories information",
     *      description="Returns category data",
     *      @OA\Parameter(name="locale",description="Locale", required=false, in="query"),
     *      @OA\Parameter(name="store_id",description="Store Id", required=true, in="query"),
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
        return $this->uri($request, env("PRODUCT_API"));
    }

    /**
     * @OA\Post(
     *      path="/api/categories",
     *      operationId="create",
     *      tags={"Categories"},
     *      summary="Post a new category",
     *      description="Create a category",
     *      @OA\Parameter(name="locale", description="Locale", required=true, in="query"),
     *      @OA\Parameter(name="text", description="Description", required=true, in="query"),
     *      @OA\Parameter(name="store_id", description="Store Id", required=true, in="query"),
     *      @OA\Parameter(name="default", description="Default", required=true, in="query"),
     *      @OA\Response(response=201,description="Category created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function create(Request $request): JsonResponse
    {
        return $this->uri($request, env("PRODUCT_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/categories/{id}",
     *      operationId="delete",
     *      tags={"Categories"},
     *      summary="Delete a category",
     *      description="Soft delete a category",
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
     *          required=true,
     *          in="query",
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Category deleted"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function delete(Request $request):JsonResponse
    {
        return $this->uri($request, env("PRODUCT_API"));
    }

    /**
     * @OA\Post(
     *      path="/api/categories/{id}/translate",
     *      operationId="addTranslation",
     *      tags={"Categories Translations"},
     *      summary="Post a new category translation",
     *      description="Create a new translation",
     *      @OA\Parameter(name="locale", description="Locale", required=true, in="query"),
     *      @OA\Parameter(name="id", description="Category id", required=true, in="query"),
     *      @OA\Parameter(name="text", description="Text", required=true, in="query"),
     *      @OA\Response(response=201,description="Translation created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function addTranslation(Request $request): JsonResponse
    {
        return $this->uri($request, env("PRODUCT_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/categories/{id}/translate",
     *      operationId="removeTranslation",
     *      tags={"Categories Translations"},
     *      summary="Delete a category translation",
     *      description="Soft delete a translation",
     *     @OA\Parameter(
     *          name="locale",
     *          description="Locale",
     *          required=true,
     *          in="query",
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
     *          required=true,
     *          in="query",
     *      ),
     *      @OA\Response(response=200, description="Translation deleted"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function removeTranslation(Request $request): JsonResponse
    {
        return $this->uri($request, env("PRODUCT_API"));
    }
}
