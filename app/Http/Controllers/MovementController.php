<?php

namespace App\Http\Controllers;
set_time_limit(0);

use App\Jobs\BackwardJob;
use App\Jobs\ExitJob;
use App\Jobs\ForwardJob;
use App\Jobs\RunJob;
use App\Jobs\StopJob;
use App\Traits\MicroserviceTrait;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use OpenApi\Annotations as OA;

class MovementController extends Controller
{
    use MicroserviceTrait;
    /**
     * @OA\Post(
     *      path="/api/movements/run",
     *      operationId="run",
     *      tags={"Movements"},
     *      summary="Run the car",
     *      description="Run the car forward",
     *      @OA\Response(response=200, description="successful operation"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function run(Request $request): JsonResponse
    {
        return $this->uri($request, env("MOVEMENT_API"));
    }

    /**
     * @OA\Post(
     *      path="/api/movements/stop",
     *      operationId="stop",
     *      tags={"Movements"},
     *      summary="Stop the car",
     *      description="Stop the car",
     *      @OA\Response(response=200, description="successful operation"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function stop(Request $request): JsonResponse
    {
        return $this->uri($request, env("MOVEMENT_API"));
    }

    /**
     * @OA\Post(
     *      path="/api/movements/backward",
     *      operationId="backward",
     *      tags={"Movements"},
     *      summary="backward the car",
     *      description="backward the car",
     *      @OA\Response(response=200, description="successful operation"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function backward(Request $request): JsonResponse
    {
        return $this->uri($request, env("MOVEMENT_API"));
    }

    /**
     * @OA\Post(
     *      path="/api/movements/forward",
     *      operationId="forward",
     *      tags={"Movements"},
     *      summary="forward the car",
     *      description="forward the car",
     *      @OA\Response(response=200, description="successful operation"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function forward(Request $request): JsonResponse
    {
        return $this->uri($request, env("MOVEMENT_API"));
    }

    /**
     * @OA\Post(
     *      path="/api/movements/exit",
     *      operationId="exit",
     *      tags={"Movements"},
     *      summary="exit the car",
     *      description="exit the car",
     *      @OA\Response(response=200, description="successful operation"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function exit(Request $request): JsonResponse
    {
        return $this->uri($request, env("MOVEMENT_API"));
    }
}
