<?php

namespace App\Service\Cache;

use App\Helpers\Helpers;
use App\Model\Category;
use App\Model\Post;
use App\Model\Product;
use App\Repository\Admins\Setting\SettingRepositoryInterface;
use App\Service\Clients\AdvertisementService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AllCacheService
{

    private $homePageCacheService;
    private $categoryCacheService;
    private $productCacheService;
    private $postCacheService;
    private $advService;

    public function __construct(HomePageService $homePageCacheService,
                                CategoryCacheService $categoryCacheService,
                                ProductCacheService $productCacheService,
                                PostCacheService $postCacheService,
                                AdvertisementService $advService
    )
    {
        $this->homePageCacheService = $homePageCacheService;
        $this->categoryCacheService = $categoryCacheService;
        $this->productCacheService = $productCacheService;
        $this->postCacheService = $postCacheService;
        $this->advService = $advService;
    }

    public function createCache($status = false)
    {
        if(!$status) return true;

        //home
        $this->homePageCacheService->index("system");

        //categories
        $categories = Category::select("slug")->where("status", 1)->get();
        foreach ($categories as $row) {
            $this->categoryCacheService->index($row->slug, "system");
        }

        //products
        $products = Product::where("status", 1)->get();
        foreach ($products as $row) {
            $this->productCacheService->show($row->slug, "system");
            $this->productCacheService->showDownload($row->slug, "system");

            $files = explode("|", $row->file_multi);
            $arr = [];
            foreach ($files as $r) {
                if (!empty($r)) $arr[] = $r;
            }

            $file_apps = explode("|", $row->app_name_multi);
            $arr_appname = [];
            foreach ($file_apps as $r) {
                if (!empty($r)) $arr_appname[] = $r;
            }

            $this->productCacheService->showDownloadApp("original-version-1", $row->slug, "system");

            foreach($arr as $k => $r) {
                $this->productCacheService->showDownloadApp("last-version-" . ($k + 1), $row->slug, "system");
            }
        }

        //posts
        $posts = Post::select("slug")->where("status", 1)->get();
        foreach ($posts as $row) {
            $this->postCacheService->show($row->slug, "system");
        }

    }

}
