<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Traits\MicroserviceTrait;
use Intervention\Image\Facades\Image as ImageFacade;
use App\Traits\IdTrait;
use App\Traits\ImageTrait;
use App\Traits\PaginationTrait;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Traits\FiltersTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use OpenApi\Annotations as OA;
use PDOException;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class ImageController extends Controller
{
    use MicroserviceTrait;
    /**
     * @OA\Get(
     *      path="/api/images",
     *      operationId="list",
     *      tags={"Images"},
     *      summary="Get all images",
     *      description="Returns images",
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
        return $this->uri($request, env("IMAGE_API"));
    }

    /**
     * @OA\Post(
     *      path="/api/images",
     *      operationId="upload",
     *      tags={"Images"},
     *      summary="Post a new image",
     *      description="Create a new image",
     *      @OA\MediaType(mediaType="multipart/form-data"),
     *      @OA\Parameter(name="checksum", description="Checksum of the file", required=true, in="query"),
     *      @OA\Response(response=201,description="Image uploaded"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}},
     *      @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                  property="file",
     *                  type="array",
     *                  @OA\Items(
     *                       type="string",
     *                       format="binary",
     *                  ),
     *               ),
     *           ),
     *       )
     *     ),
     * )
     */
    public function upload(Request $request): JsonResponse
    {
        return $this->uri($request, env("IMAGE_API"));
    }

    /**
     * @OA\Get(
     *      path="/api/images/{id}",
     *      operationId="retrieve",
     *      tags={"Images"},
     *      summary="Get an image",
     *      description="Returns an image",
     *      @OA\Parameter(name="id",description="Image id",required=true,in="path"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Account not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error")
     * )
     */
    public function retrieve(Request $request): JsonResponse
    {
        return $this->uri($request, env("IMAGE_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/images/{id}",
     *      operationId="delete",
     *      tags={"Images"},
     *      summary="Delete an image",
     *      description="Soft delete an image",
     *      @OA\Parameter(name="id",description="Image id",required=true,in="path"),
     *      @OA\Response(response=200,description="Image deleted"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function delete(Request $request): JsonResponse
    {
        return $this->uri($request, env("IMAGE_API"));
    }
}
