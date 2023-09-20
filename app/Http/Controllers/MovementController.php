<?php

namespace App\Http\Controllers;
set_time_limit(0);
use App\Jobs\BackwardJob;
use App\Jobs\ExitJob;
use App\Jobs\ForwardJob;
use App\Jobs\RunJob;
use App\Jobs\StopJob;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use OpenApi\Annotations as OA;

class MovementController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/movements/left",
     *      operationId="left",
     *      tags={"Movements"},
     *      summary="Go left",
     *      description="Move the car to the left",
     *      @OA\Response(response=200, description="successful operation"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function left(Request $request): JsonResponse
    {
        try {
            RunJob::dispatch("left")->onQueue('left');

            return response()->json("Go left");
        } catch (Exception $e) {

            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/movements/right",
     *      operationId="right",
     *      tags={"Movements"},
     *      summary="Go right",
     *      description="Move the car to the right",
     *      @OA\Response(response=200, description="successful operation"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function right(Request $request): JsonResponse
    {
        try {
            RunJob::dispatch("right")->onQueue('right');

            return response()->json("Go right");
        } catch (Exception $e) {

            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/movements/start-engine",
     *      operationId="startEngine",
     *      tags={"Movements"},
     *      summary="Start the engine",
     *      description="Start engine",
     *      @OA\Response(response=200, description="successful operation"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function startEngine(Request $request): JsonResponse
    {
        try {
            RunJob::dispatch("start_engine")->onQueue('start_engine');

            return response()->json("Start engine");
        } catch (Exception $e) {

            return response()->json($e->getMessage(), 500);
        }
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
        try {
            StopJob::dispatch([
                'command' => "stop",
            ])->onQueue('stop');

            return response()->json("STOP", 200);
        } catch (Exception $e) {

            return response()->json($e->getMessage(), 500);
        }
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
        try {
            BackwardJob::dispatch([
                'command' => "backward",
            ])->onQueue('backward');

            return response()->json("BACKWARD", 200);
        } catch (Exception $e) {

            return response()->json($e->getMessage(), 500);
        }
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
        try {
            ForwardJob::dispatch([
                'command' => "forward",
            ])->onQueue('forward');

            return response()->json("FORWARD", 200);
        } catch (Exception $e) {

            return response()->json($e->getMessage(), 500);
        }
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
        try {
            ExitJob::dispatch([
                'command' => "exit",
            ])->onQueue('exit');

            return response()->json("EXIT", 200);
        } catch (Exception $e) {

            return response()->json($e->getMessage(), 500);
        }
    }
}
