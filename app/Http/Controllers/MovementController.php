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
     *      path="/api/movements/run",
     *      operationId="run",
     *      tags={"Movement"},
     *      summary="Run the car",
     *      description="Run the car forward",
     *      @OA\Response(response=200, description="successful operation"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function run(Request $request): JsonResponse
    {
        try {
            RunJob::dispatch([
                'command' => "run",
            ])->onQueue('run');

            return response()->json("RUN", 200);
        } catch (Exception $e) {

            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/movements/stop",
     *      operationId="stop",
     *      tags={"Movement"},
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
     * @OA\Get(
     *      path="/api/movements/backward",
     *      operationId="backward",
     *      tags={"Movement"},
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
     * @OA\Get(
     *      path="/api/movements/forward",
     *      operationId="forward",
     *      tags={"Movement"},
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
     * @OA\Get(
     *      path="/api/movements/exit",
     *      operationId="exit",
     *      tags={"Movement"},
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
