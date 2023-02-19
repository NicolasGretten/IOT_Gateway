<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class StoreTranslationController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Post(
     *      path="/api/stores/{id}/translations",
     *      operationId="addTranslation",
     *      tags={"Stores Translations"},
     *      summary="Post a new store translation",
     *      description="Create a new translation",
     *      @OA\Parameter(name="id", description="Store id", required=true, in="query"),
     *      @OA\Parameter(name="locale", description="fr or en", required=true, in="query"),
     *      @OA\Parameter(name="description", description="Description", required=true, in="query"),
     *      @OA\Response(response=201,description="Translation created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function addTranslation(Request $request): JsonResponse
    {
        return $this->uri($request, env("STORE_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/stores/{id}/translations",
     *      operationId="removeTranslation",
     *      tags={"Stores Translations"},
     *      summary="Delete a store translation",
     *      description="Soft delete a translation",
     *      @OA\Parameter(name="id",description="Store id",required=true,in="query"),
     *      @OA\Parameter(name="locale", description="fr or en", required=true, in="query"),
     *      @OA\Response(response=200, description="Translation deleted"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function removeTranslation(Request $request): JsonResponse
    {
        return $this->uri($request, env("STORE_API"));
    }
}
