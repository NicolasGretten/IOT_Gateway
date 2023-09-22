<?php

namespace App\Http\Controllers;
set_time_limit(0);
use App\Jobs\BackwardJob;
use App\Jobs\ExitJob;
use App\Jobs\ForwardJob;
use App\Jobs\RfidJob;
use App\Jobs\RunJob;
use App\Jobs\StopJob;
use App\Models\Image;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use OpenApi\Annotations as OA;
use Pusher\Pusher;

class ImageController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/images/upload",
     *      operationId="upload",
     *      tags={"Images"},
     *      summary="Upload an image",
     *      description="Upload an image and send it to the front",
     *      @OA\Parameter(name="file", description="BASE64", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function upload(Request $request): JsonResponse
    {
        try {

            $image = new Image();
            $image->image = $request->file;
            $image->save();

            $app_id = env('PUSHER_APP_ID');
            $app_key = env('PUSHER_APP_KEY');
            $app_secret = env('PUSHER_APP_SECRET');
            $app_cluster = 'eu';

            $pusher = new Pusher($app_key, $app_secret, $app_id, ['cluster' => $app_cluster]);
            $pusher->trigger('image', 'image', $image->id);

            return response()->json($image->id,200);
        } catch (Exception | GuzzleException $e) {
            Log::debug($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/images/{id}",
     *      operationId="getImage",
     *      tags={"Images"},
     *      summary="Get an image",
     *      description="Get an image",
     *      @OA\Parameter(name="id", description="ID", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function getImage(Request $request): JsonResponse
    {
        try {
            $image = Image::orderBy('id', 'DESC')->first();
            $imageDelete = Image::orderBy('id', 'DESC')->first();

            $imageDelete->delete();
            return response()->json($image, 200);
        } catch (Exception | GuzzleException $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
