<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class ProductController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Get(
     *      path="/api/products/{id}",
     *      operationId="retrieve",
     *      tags={"Products"},
     *      summary="Get product information",
     *      description="Returns product data",
     *      @OA\Parameter(name="locale",description="Locale", required=false, in="query"),
     *      @OA\Parameter(name="id",description="Product id", required=true, in="query"),
     *      @OA\Parameter(name="store_id",description="Store Id", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Product not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error")
     * )
     */
    public function retrieve(Request $request): JsonResponse
    {
        return $this->uri($request, env("PRODUCT_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/products",
     *      operationId="list",
     *      tags={"Products"},
     *      summary="Get all products information",
     *      description="Returns product data",
     *      @OA\Parameter(name="locale",description="Locale", required=false, in="query"),
     *      @OA\Parameter(name="store_id",description="Store Id", required=true, in="query"),
     *      @OA\Parameter(name="category_id",description="Category Id", required=false, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error")
     * )
     */
    public function list(Request $request): JsonResponse
    {
        return $this->uri($request, env("PRODUCT_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/admin/products/",
     *      operationId="listAll",
     *      tags={"Products"},
     *      summary="Get all products information ADMIN",
     *      description="Returns product data",
     *      @OA\Parameter(name="locale",description="Locale", required=false, in="query"),
     *      @OA\Parameter(name="category_id",description="Category Id", required=false, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function listAll(Request $request): JsonResponse
    {
        return $this->uri($request, env("PRODUCT_API"));
    }

    /**
     * @OA\Post(
     *      path="/api/products",
     *      operationId="create",
     *      tags={"Products"},
     *      summary="Post a new product",
     *      description="Create a product",
     *      @OA\Parameter(name="locale", description="Locale", required=true, in="query"),
     *      @OA\Parameter(name="label", description="Label", required=true, in="query"),
     *      @OA\Parameter(name="description", description="Description", required=true, in="query"),
     *      @OA\Parameter(name="reference", description="Reference", required=false, in="query"),
     *      @OA\Parameter(name="category_id", description="Category Id", required=true, in="query"),
     *      @OA\Parameter(name="store_id", description="Store Id", required=true, in="query"),
     *      @OA\Parameter(name="image_id", description="Image Id", required=true, in="query"),
     *      @OA\Parameter(name="available", description="Available", required=true, in="query"),
     *      @OA\Parameter(name="ht", description="HT", required=true, in="query"),
     *      @OA\Parameter(name="tva_rate", description="TVA rate", required=false, in="query"),
     *      @OA\Response(response=201,description="Product created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function create(Request $request): JsonResponse
    {
        return $this->uri($request, env("PRODUCT_API"));
    }

    /**
     * @OA\Patch (
     *      path="/api/products/{id}",
     *      operationId="update",
     *      tags={"Products"},
     *      summary="Patch a product",
     *      description="Update a product",
     *      @OA\Parameter(name="id",description="Product id", required=true, in="query"),
     *      @OA\Parameter(name="available", description="available", required=false, in="query"),
     *      @OA\Parameter(name="category_id", description="Category Id", required=false, in="query"),
     *      @OA\Parameter(name="image_id", description="Image Id", required=false, in="query"),
     *      @OA\Parameter(name="reference", description="Reference", required=false, in="query"),
     *      @OA\Response(
     *          response=200,
     *          description="Store updated"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function update(Request $request): JsonResponse
    {
        return $this->uri($request, env("PRODUCT_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/products/{id}",
     *      operationId="delete",
     *      tags={"Products"},
     *      summary="Delete a product",
     *      description="Soft delete a product",
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="query",
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Product deleted"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     *
     * )
     */
    public function delete(Request $request): JsonResponse
    {
        return $this->uri($request, env("PRODUCT_API"));
    }

    /**
     * @OA\Post(
     *      path="/api/products/{id}/translate",
     *      operationId="addTranslation",
     *      tags={"Products Translations"},
     *      summary="Post a new product translation",
     *      description="Create a new translation",
     *      @OA\Parameter(name="id", description="Product id", required=true, in="query"),
     *      @OA\Parameter(name="locale", description="Locale", required=true, in="query"),
     *      @OA\Parameter(name="label", description="Label", required=false, in="query"),
     *      @OA\Parameter(name="description", description="Description", required=false, in="query"),
     *      @OA\Response(response=201,description="Translation created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function addTranslation(Request $request): JsonResponse
    {
        return $this->uri($request, env("PRODUCT_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/products/{id}/translate",
     *      operationId="removeTranslation",
     *      tags={"Products Translations"},
     *      summary="Delete a product translation",
     *      description="Soft delete a translation",
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="query",
     *      ),
     *     @OA\Parameter(
     *          name="locale",
     *          description="Locale",
     *          required=true,
     *          in="query",
     *      ),
     *      @OA\Response(response=200, description="Translation deleted"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function removeTranslation(Request $request): JsonResponse
    {
        return $this->uri($request, env("PRODUCT_API"));
    }

    /**
     * @OA\Patch (
     *      path="/api/products/{id}/price",
     *      operationId="updatePrice",
     *      tags={"Products"},
     *      summary="Patch a product price",
     *      description="Update a product price",
     *      @OA\Parameter(name="id",description="Product id", required=true, in="query"),
     *      @OA\Parameter(name="ht", description="HT, in cent example: 1€ = 100", required=true, in="query"),
     *      @OA\Parameter(name="tva_rate", description="TVA rate, in cent example: 10% = 1000", required=true, in="query"),
     *      @OA\Response(
     *          response=200,
     *          description="Store updated"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function updatePrice(Request $request): JsonResponse
    {
        return $this->uri($request, env("PRODUCT_API"));
    }

    /**
     * @OA\Post (
     *      path="/api/products/{id}/cart",
     *      operationId="addToCart",
     *      tags={"Products"},
     *      summary="Add a product to a shopping cart",
     *      description="Send pub to cart API",
     *      @OA\Parameter(name="id",description="Product id", required=true, in="query"),
     *      @OA\Parameter(name="quantity",description="Quantity", required=true, in="query"),
     *      @OA\Parameter(name="cart_id", description="Cart Id", required=true, in="query"),
     *      @OA\Response(response=200,description="Added to Cart updated"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function addToCart(Request $request): JsonResponse
    {
        return $this->uri($request, env("PRODUCT_API"));
    }
}
