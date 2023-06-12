<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App;
use DB;
use Carbon\Carbon;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

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
        //create new sitemap object
        $sitemap = App::make("sitemap");

        //add items to the sitemap (url, date, priority, freq)
        $sitemap->add(\URL::to('/'), Carbon::now(), '1.0', 'daily');
        //$sitemap->add(\URL::to('/id'), Carbon::now(), '1.0', 'daily');
        //$sitemap->add(\URL::to('/ph'), Carbon::now(), '1.0', 'daily');

        //get all posts from db
        $posts = DB::table('categories')->orderBy('created_at', 'asc')->get();
        foreach ($posts as $row)
        {
            $route = "";
            if($row->id == 1){
                $sitemap->add(asset($route), $row->updated_at, 1, 'daily');
            }else {
                $sitemap->add(asset($route . $row->slug), $row->updated_at, 1, 'daily');
            }
        }
//        foreach ($posts as $row)
//        {
//            $route = "es/";
//            if($row->id == 1){
//                $sitemap->add(asset($route), $row->updated_at, 1, 'daily');
//            }else {
//                $sitemap->add(asset($route . $row->slug), $row->updated_at, 1, 'daily');
//            }
//        }
//        foreach ($posts as $row)
//        {
//            $route = "pt/";
//            if($row->id == 1){
//                $sitemap->add(asset($route), $row->updated_at, 1, 'daily');
//            }else {
//                $sitemap->add(asset($route . $row->slug), $row->updated_at, 1, 'daily');
//            }
//        }
//        foreach ($posts as $row)
//        {
//            $route = "id/";
//            if($row->id == 1){
//                $sitemap->add(asset($route), $row->updated_at, 1, 'daily');
//            }else {
//                $sitemap->add(asset($route . $row->slug), $row->updated_at, 1, 'daily');
//            }
//        }
//        foreach ($posts as $row)
//        {
//            $route = "ph/";
//            if($row->id == 1){
//                $sitemap->add(asset($route), $row->updated_at, 1, 'daily');
//            }else {
//                $sitemap->add(asset($route . $row->slug), $row->updated_at, 1, 'daily');
//            }
//        }

        $posts = DB::table('products')->orderBy('created_at', 'asc')->get();
        foreach ($posts as $row)
        {
            $route = "";
            $sitemap->add(asset($route.$row->slug.'.htm'), $row->updated_at, 0.8, 'daily');
        }
//        foreach ($posts as $row)
//        {
//            $route = "es/";
//            $sitemap->add(asset($route.$row->slug.'.htm'), $row->updated_at, 0.8, 'daily');
//        }
//        foreach ($posts as $row)
//        {
//            $route = "pt/";
//            $sitemap->add(asset($route.$row->slug.'.htm'), $row->updated_at, 0.8, 'daily');
//        }

//        $posts = DB::table('products')->where("choose_8", 1)->orderBy('created_at', 'asc')->get();
//        foreach ($posts as $row)
//        {
//            $route = "id/";
//            $sitemap->add(asset($route.$row->slug.'.htm'), $row->updated_at, 0.8, 'daily');
//        }
//        $posts = DB::table('products')->where("choose_9", 1)->orderBy('created_at', 'asc')->get();
//        foreach ($posts as $row)
//        {
//            $route = "ph/";
//            $sitemap->add(asset($route.$row->slug.'.htm'), $row->updated_at, 0.8, 'daily');
//        }

        $posts = DB::table('posts')->orderBy('created_at', 'asc')->get();
        foreach ($posts as $row)
        {
            $route = "";
            $sitemap->add(asset($route.$row->slug.'.html'), $row->updated_at, 0.7, 'daily');
        }
//        foreach ($posts as $row)
//        {
//            $route = "es/";
//            $sitemap->add(asset($route.$row->slug.'.html'), $row->updated_at, 0.7, 'daily');
//        }
//        foreach ($posts as $row)
//        {
//            $route = "pt/";
//            $sitemap->add(asset($route.$row->slug.'.html'), $row->updated_at, 0.7, 'daily');
//        }
//        foreach ($posts as $row)
//        {
//            $route = "id/";
//            $sitemap->add(asset($route.$row->slug.'.html'), $row->updated_at, 0.7, 'daily');
//        }

        //generate your sitemap (format, filename)
        $sitemap->store('xml', 'sitemap');
    }
}
