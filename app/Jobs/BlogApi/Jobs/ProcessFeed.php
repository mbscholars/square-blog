<?php

namespace App\Jobs\BlogApi\Jobs;

use Illuminate\Bus\Queueable;
use App\BlogApi\Facades\BlogApi;

use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Exceptions\FeedProcessFailureException;

class ProcessFeed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * @param \Throwable $exception
     * @return void
     */
    public function failed(\Throwable $exception)
    {
        throw new FeedProcessFailureException($exception->getMessage());
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->attempts() > 1) {
            Log::info('ProcessFeed Job is being retried! Count:' . $this->attempts());
        }

        BlogApi::process();
    }
}
