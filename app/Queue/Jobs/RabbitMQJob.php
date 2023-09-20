<?php

namespace App\Queue\Jobs;

use App\Jobs\RfidJob;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob as BaseJob;

class RabbitMQJob extends BaseJob
{

    /**
     * Fire the job.
     *
     * @return void
     */
    public function fire()
    {
        $payload = $this->payload();

        $method = 'handle';
        echo 'fire -';

        ($this->instance = $this->resolve($payload['job']))->{$method}($payload['data']);
        echo 'done -';

        $this->delete();
    }

    public function payload()
    {
        return [
            'job'  => RfidJob::class,
            'data' => json_decode($this->getRawBody(), true)
        ];
    }
}
