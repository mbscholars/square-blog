<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\BlogApi\Facades\BlogApi;

class ImportBlog extends Command
{

    protected $signature = 'blog:import';

    /**
     * The console blog description.
     *
     * @var string
     */
    protected $description = 'This command imports posts from a given external Api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        BlogApi::import();
        dump("Posts successfully imported!");
    }
}
