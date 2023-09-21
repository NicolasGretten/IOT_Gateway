<?php

namespace App\Jobs;

use App\Events\MyEvent;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Pusher\Pusher;

class ObstacleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($data)
    {
        try{

            Log::debug("HANDLE");
            $app_id = env('PUSHER_APP_ID');
            $app_key = env('PUSHER_APP_KEY');
            $app_secret = env('PUSHER_APP_SECRET');
            $app_cluster = 'eu';

            $pusher = new Pusher($app_key, $app_secret, $app_id, ['cluster' => $app_cluster]);
            $pusher->trigger('obstacle', 'obstacle', 'hello world');

        }
        catch (\Exception | GuzzleException $e){
            echo($e->getMessage());
        }
    }
}
