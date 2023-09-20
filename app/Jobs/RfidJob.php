<?php

namespace App\Jobs;

use App\Models\Account;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Bus\Queueable;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob as BaseJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RfidJob implements ShouldQueue
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
//            $data = json_decode(json_encode($this->data), true);
//            $account = Account::where('id', $data['account_id'])->first();
//            if(!empty($account) && $account->role !== $data['role']){
//                $account->role = $data['role'];
//                $account->save();
//            }
            StartEngineJob::dispatch( ["message" => "start_engine"])->onQueue('start_engine');


        }
        catch (\Exception $e){
            echo($e->getMessage());
        }
    }
}
