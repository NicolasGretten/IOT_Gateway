<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Log;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob as BaseJob;

class RfidJob extends BaseJob
{

    /**
     * Fire the job.
     *
     * @return void
     */
    public function fire()
    {
        Log::debug("FIRE");
        $payload = $this->payload();

        $class = RfidJobOld::class;
        $method = 'handle';

        ($this->instance = $this->resolve($class))->{$method}($this, $payload);

        $this->delete();
    }


}
