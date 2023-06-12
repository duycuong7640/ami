<?php

namespace App\Console\Commands;

use App\Helpers\Helpers;
use App\Model\Product;
use Illuminate\Console\Command;

class imageToJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:imageToJson';

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
        $data = Product::select("id", "thumbnail", "play_image_down", "slug")->get();


        //\App\Helpers\Helpers::renderThumb($row->thumbnail, 'tophot'.$strmb)
        //\App\Helpers\Helpers::renderThumb($row->play_image_down, 'tophot'.$strmb)
        //\App\Helpers\Helpers::renderThumb($row->thumbnail, 'itemgame'.$strmb)
        //\App\Helpers\Helpers::renderThumb($row->play_image_down, 'itemgame'.$strmb)
        //itemgame

        $mobile = "_mobile";
        $arr = [];
        $folder = "/static/images/".time();
        mkdir(public_path($folder), 0777, true);

        foreach ($data as $row) {
            $thumbnail_big_pc_file = "";
            $thumbnail_big_mobile_file = "";
            $thumbnail_small_pc_file = "";
            $thumbnail_small_mobile_file = "";
            if(file_exists(public_path($row->thumbnail)) && !empty($row->thumbnail)) {
                $thumbnail_big_pc = @file_get_contents(Helpers::renderThumb($row->thumbnail, 'tophot'));
                $thumbnail_big_pc_file = $folder . "/" . $row->slug . "-" . time() . rand(10000000, 99999999) . ".jpeg";
                @file_put_contents(public_path($thumbnail_big_pc_file), $thumbnail_big_pc);
                $thumbnail_big_mobile = @file_get_contents(Helpers::renderThumb($row->thumbnail, 'tophot' . $mobile));
                $thumbnail_big_mobile_file = $folder . "/" . $row->slug . "-" . time() . rand(10000000, 99999999) . ".jpeg";
                @file_put_contents(public_path($thumbnail_big_mobile_file), $thumbnail_big_mobile);

                $thumbnail_small_pc = @file_get_contents(Helpers::renderThumb($row->thumbnail, 'itemgame'));
                $thumbnail_small_pc_file = $folder . "/" . $row->slug . "-" . time() . rand(10000000, 99999999) . ".jpeg";
                @file_put_contents(public_path($thumbnail_small_pc_file), $thumbnail_small_pc);
                $thumbnail_small_mobile = @file_get_contents(Helpers::renderThumb($row->thumbnail, 'itemgame' . $mobile));
                $thumbnail_small_mobile_file = $folder . "/" . $row->slug . "-" . time() . rand(10000000, 99999999) . ".jpeg";
                @file_put_contents(public_path($thumbnail_small_mobile_file), $thumbnail_small_mobile);
            }

//            if(Helpers::checkUrlExits($row->play_image_down) && !empty($row->play_image_down)){
            $pid_big_pc_file = "";
            $pid_big_mobile_file = "";
            $pid_small_pc_file = "";
            $pid_small_mobile_file = "";
            if(file_exists(public_path($row->play_image_down)) && !empty($row->play_image_down)) {
                $pid_big_pc = @file_get_contents(Helpers::renderThumb($row->play_image_down, 'tophot'));
                $pid_big_pc_file = $folder . "/" . $row->slug . "-" . time() . rand(10000000, 99999999) . ".jpeg";
                @file_put_contents(public_path($pid_big_pc_file), $pid_big_pc);
                $pid_big_mobile = @file_get_contents(Helpers::renderThumb($row->play_image_down, 'tophot' . $mobile));
                $pid_big_mobile_file = $folder . "/" . $row->slug . "-" . time() . rand(10000000, 99999999) . ".jpeg";
                @file_put_contents(public_path($pid_big_mobile_file), $pid_big_mobile);

                $pid_small_pc = @file_get_contents(Helpers::renderThumb($row->play_image_down, 'itemgame'));
                $pid_small_pc_file = $folder . "/" . $row->slug . "-" . time() . rand(10000000, 99999999) . ".jpeg";
                @file_put_contents(public_path($pid_small_pc_file), $pid_small_pc);
                $pid_small_mobile = @file_get_contents(Helpers::renderThumb($row->play_image_down, 'itemgame' . $mobile));
                $pid_small_mobile_file = $folder . "/" . $row->slug . "-" . time() . rand(10000000, 99999999) . ".jpeg";
                @file_put_contents(public_path($pid_small_mobile_file), $pid_small_mobile);
            }

            $arr = [
                "thumbnail_big" => $thumbnail_big_pc_file,
                "thumbnail_big_mobile" => $thumbnail_big_mobile_file,
                "thumbnail_small" => $thumbnail_small_pc_file,
                "thumbnail_small_mobile" => $thumbnail_small_mobile_file,
                "play_image_down_big" => $pid_big_pc_file,
                "play_image_down_big_mobile" => $pid_big_mobile_file,
                "play_image_down_small" => $pid_small_pc_file,
                "play_image_down_small_mobile" => $pid_small_mobile_file,
            ];

            Product::where('id', $row->id)->update(["thumbnail_convert" => @json_encode($arr)]);
        }
    }
}
