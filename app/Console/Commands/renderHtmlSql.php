<?php

namespace App\Console\Commands;

use App\Service\Cache\AllCacheService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class renderHtmlSql extends Command
{
    private $allCacheService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:renderHtmlSql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AllCacheService $allCacheService)
    {
        parent::__construct();
        $this->allCacheService = $allCacheService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->allCacheService->createCache(true);
    }
}
