<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;
//use App\Jobs\Middleware\RateLimited;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\Middleware\WithoutOverlapping;



class ProcessPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Redis::throttle('key')->block(0)->allow(1)->every(5)->then(function () {
            info('Lock obtained...');

            // Handle job...
        }, function () {
            // Could not obtain lock...

            return $this->release(5);
        });
    }

    public function middleware(): array
    {
//        return [new RateLimited];
//        return [new RateLimited('backups')];
//        return [(new RateLimited('backups'))->dontRelease()];
//        return [(new WithoutOverlapping($this->user->id))];
//        return [(new WithoutOverlapping($this->order->id))->dontRelease()];
//        return [(new WithoutOverlapping($this->order->id))->releaseAfter(60)];
        return [(new WithoutOverlapping($this->order->id))->expireAfter(180)];
    }
}
