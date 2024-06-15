<?php

namespace EmailQueue;

use Illuminate\Queue\Capsule\Manager as Queue;

class QueueManager
{
    protected $queue;

    public function __construct()
    {
        $this->queue = new Queue;
        $this->queue->addConnection([
            'driver' => 'database',
            'table' => 'jobs',
            'queue' => 'default',
            'retry_after' => 90,
        ]);
        $this->queue->setAsGlobal();
        $this->queue->pop();
    }

    public function addJob(Job $job)
    {
        $this->queue->push($job);
    }

    public function processJobs()
    {
        while ($job = $this->queue->pop()) {
            $job->fire();
        }
    }
}
