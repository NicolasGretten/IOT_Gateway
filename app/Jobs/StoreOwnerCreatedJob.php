<?php

namespace App\Jobs;

use App\Models\Account;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreOwnerCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            $data = json_decode(json_encode($this->data), true);
            $account = Account::where('id', $data['account_id'])->first();
            if(!empty($account) && $account->role === null){
                $account->role = "STORE_OWNER";
                $account->role_id = $data['id'];
                $account->save();
            }
        }
        catch (\Exception $e){
            Bugsnag::notifyException($e);
        }
    }
}
