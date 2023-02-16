<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
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

class StoreSlotController extends Controller
{
    use MicroserviceTrait;

    /**
     * @OA\Post(
     *      path="/api/stores/{id}/slots",
     *      operationId="addSlot",
     *      tags={"Stores Slots"},
     *      summary="Post a new store slot",
     *      description="Create a slot",
     *      @OA\Parameter(name="id", description="Store Id", required=true, in="query"),
     *      @OA\Parameter(name="day", description="Day", required=true, in="query"),
     *      @OA\Parameter(name="from", description="From", required=true, in="query"),
     *      @OA\Parameter(name="to", description="To", in="query"),
     *      @OA\Parameter(name="quantity", description="Quantity", required=true, in="query"),
     *      @OA\Parameter(name="available", description="Availability", required=true, in="query"),
     *      @OA\Response(response=201,description="Account created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function addSlot(Request $request): JsonResponse
    {
        return $this->uri($request, env("STORE_API"));
    }

    /**
     * @OA\Patch  (
     *      path="/api/stores/{id}/slots/{slot_id}",
     *      operationId="updateSlot",
     *      tags={"Stores Slots"},
     *      summary="Update a store slot",
     *      description="update the availability and the quantity of a store slot",
     *      @OA\Parameter(
     *          name="id",
     *          description="Store id",
     *          required=true,
     *          in="query",
     *      ),
     *     @OA\Parameter(
     *          name="slot_id",
     *          description="Slot id",
     *          required=true,
     *          in="query",
     *      ),
     *      @OA\Parameter(name="quantity", description="Quantity", required=true, in="query"),
     *      @OA\Parameter(name="available", description="Availability", required=true, in="query"),
     *      @OA\Response(response=200, description="Slot updated"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function updateSlot(Request $request): JsonResponse
    {
        return $this->uri($request, env("STORE_API"));
    }

    /**
     * @OA\Delete  (
     *      path="/api/stores/{id}/slots/{slot_id}",
     *      operationId="removeSlot",
     *      tags={"Stores Slots"},
     *      summary="Delete a store slot",
     *      description="Soft delete a store slot",
     *      @OA\Parameter(
     *          name="id",
     *          description="Store id",
     *          required=true,
     *          in="query",
     *      ),
     *     @OA\Parameter(
     *          name="slot_id",
     *          description="Slot id",
     *          required=true,
     *          in="query",
     *      ),
     *      @OA\Response(response=200, description="Slot deleted"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function removeSlot(Request $request): JsonResponse
    {
        return $this->uri($request, env("STORE_API"));
    }
}
