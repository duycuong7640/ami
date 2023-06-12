<?php

namespace App\Console\Commands;

use App\Helpers\Helpers;
use App\Service\Clients\ClientProductService;
use Illuminate\Console\Command;
use Raulr\GooglePlayScraper\Scraper;

class updateVersion extends Command
{

    private $function;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateVersion';

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
    public function __construct(ClientProductService $function)
    {
        parent::__construct();
        $this->function = $function;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $data = $this->function->getListAllJob();
//        $gplay = new \Nelexa\GPlay\GPlayApps($defaultLocale = 'en_US', $defaultCountry = 'us');
//        foreach ($data as $row) {
//            try {
//                if (!empty($row->code)) {
//                    $info = $gplay->getAppInfo($row->code);
//                    if ($info->getAppVersion() != $row->play_last_version) {
//                        $info = [
//                            "play_last_version" => $info->getAppVersion(),
//                            "play_last_version_updated" => date("Y/m/d H:i:s"),
//                        ];
//
//                        if (!empty($info["play_last_version"])) $this->function->update($info, $row->id);
//                    }
//                    sleep(5);
//                }
//            } catch (\Exception $e) {
//            }
//        }

        $data = $this->function->getListAllJob();
        foreach ($data as $row) {
            try {
                if (!empty($row->code)) {
                    $info = Helpers::getInfoAppId($row->code);
                    if(!empty($info["version"])) {
                        if ($info["version"] != $row->play_last_version) {
                            $info = [
                                "play_last_version" => $info["version"],
                                "play_last_version_updated" => date("Y/m/d H:i:s"),
                            ];

                            if (!empty($info["play_last_version"])) $this->function->update($info, $row->id);
                        }
                    }
                    sleep(5);
                }
            } catch (\Exception $e) {
            }
        }

    }
}
