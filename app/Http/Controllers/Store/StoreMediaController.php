<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Traits\FiltersTrait;
use App\Traits\IdTrait;
use App\Traits\JwtTrait;
use App\Traits\MicroserviceTrait;
use App\Traits\PaginationTrait;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\JsonEncodingException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use OpenApi\Annotations as OA;

class StoreMediaController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Post(
     *      path="/api/stores/{id}/medias",
     *      operationId="addMedia",
     *      tags={"Stores Medias"},
     *      summary="Post a new store media",
     *      description="Create a media",
     *      @OA\Parameter(name="id", description="Store Id", required=true, in="query"),
     *      @OA\Parameter(name="url", description="URL", required=true, in="query"),
     *      @OA\Parameter(name="type", description="Media type", required=true, in="query"),
     *      @OA\Response(response=201,description="Media created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function addMedia(Request $request): JsonResponse
    {
        return $this->uri($request, env("STORE_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/stores/{id}/medias/{media_id}",
     *      operationId="removeMedia",
     *      tags={"Stores Medias"},
     *      summary="Delete a store media",
     *      description="Soft delete a media",
     *      @OA\Parameter(
     *          name="id",
     *          description="Store id",
     *          required=true,
     *          in="query",
     *      ),
     *     @OA\Parameter(
     *          name="media_id",
     *          description="Media id",
     *          required=true,
     *          in="query",
     *      ),
     *      @OA\Response(response=200, description="Media deleted"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function removeMedia(Request $request): JsonResponse
    {
        return $this->uri($request, env("STORE_API"));
    }
}
