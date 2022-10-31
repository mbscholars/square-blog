<?php

namespace App\Console\Commands;

use App\Facade\UrlCache;
use App\Enums\CachedPages;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ProjectSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets up the project';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call("db:seed");
        Artisan::call("blog:import");

        return dump("All Done! Hurrayi!");
    }
}
