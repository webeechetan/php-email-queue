<?php

namespace EmailQueue;

use Illuminate\Queue\SerializesModels;

abstract class Job
{
    use SerializesModels;

    public function handle()
    {
        //
    }
}
