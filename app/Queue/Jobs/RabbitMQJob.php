<?php

namespace App\Queue\Jobs;

use App\Jobs\ObstacleJob;
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

        echo $this->getQueue();
        echo '    ';
        echo $payload['job'];

        $method = 'handle';

        ($this->instance = $this->resolve($payload['job']))->{$method}($payload['data']);

        $this->delete();
    }

    public function payload()
    {
        return match ($this->getQueue()) {
            'obstacle' => [
                'job' => ObstacleJob::class,
                'data' => json_decode($this->getRawBody(), true)
            ],
            'rfid' => [
                'job' => RfidJob::class,
                'data' => json_decode($this->getRawBody(), true)
            ],
            default => [

            ],
        };
    }
}
