<?php

namespace App\Http\Controllers;
set_time_limit(0);
use App\Jobs\BackwardJob;
use App\Jobs\ExitJob;
use App\Jobs\ForwardJob;
use App\Jobs\RfidJob;
use App\Jobs\RunJob;
use App\Jobs\StopJob;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use OpenApi\Annotations as OA;

class ImageController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/images/",
     *      operationId="upload",
     *      tags={"Images"},
     *      summary="Upload an image",
     *      description="Upload an image and send it to the front",
     *      @OA\Response(response=200, description="successful operation"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function upload(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'file' => 'string|required',
            ]);

            return response()->json($request->file,200);
        } catch (Exception $e) {

            return response()->json($e->getMessage(), 500);
        }
    }
}
