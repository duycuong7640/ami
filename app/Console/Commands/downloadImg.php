<?php

namespace App\Console\Commands;

use App\Helpers\Helpers;
use App\Model\Product;
use Illuminate\Console\Command;

class downloadImg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:downloadImg';

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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = Product::select("id", "play_image", "slug")->whereNull("play_image_down")->where("play_image", "LIKE", "https://play%")->get();

	//$data = Product::select("id", "play_image", "slug")->where("play_image", "LIKE", "https://play%")->get();
        foreach ($data as $row) {
            $img = @file_get_contents($row->play_image);
            $file = "/storage/photos/down/" . $row->slug . "-" . time() . ".jpeg";
            @file_put_contents(public_path($file), $img);

            Product::where('id', $row->id)->update(["play_image_down" => $file]);
        }
    }
}
