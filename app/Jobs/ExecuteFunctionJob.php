<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class ExecuteFunctionJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $class;
    protected $method;

    public function __construct($class, $method)
    {
        $this->class = $class;
        $this->method = $method;
    }

    public function handle()
    {
        try {
            // Call the method dynamically
            $result = app($this->class)->{$this->method}();

            // Save job result to Redis
            Redis::set("job:{$this->job->getJobId()}:status", 'completed');
            Redis::set("job:{$this->job->getJobId()}:result", json_encode($result));
        } catch (\Exception $e) {
            Redis::set("job:{$this->job->getJobId()}:status", 'failed');
            Redis::set("job:{$this->job->getJobId()}:error", $e->getMessage());
        }
    }
}
