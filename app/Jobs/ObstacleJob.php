<?php

namespace App\Jobs;

use App\Events\ChatMessageSent;
use App\Models\Account;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob as BaseJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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

//            DO WEBSOCKET SHIT
            $channelName = 'chat.room1'; // Le nom du canal WebSocket où vous souhaitez envoyer le message
            $messageData = [
                'message' => 'Hello from Laravel!',
            ];

            Log::debug("before event");
            broadcast(new ChatMessageSent('test'))->toOthers();
            Log::debug("after event");

        }
        catch (\Exception $e){
            echo($e->getMessage());
        }
    }
}
