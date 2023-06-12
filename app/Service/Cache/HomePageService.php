<?php

namespace App\Service\Cache;

use App\Helpers\Helpers;
use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\ClientPostService;
use App\Service\Clients\ClientProductService;
use App\Service\Clients\SettingService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class HomePageService
{

    private $clientSettingService;
    private $clientAdvService;
    private $clientCategoryService;
    private $clientProductService;
    private $clientPostService;
    private $setting;
    public $type = "home";

    public function __construct(SettingService $clientSettingService,
                                AdvertisementService $clientAdvService,
                                ClientCategoryService $clientCategoryService,
                                ClientProductService $clientProductService,
                                ClientPostService $clientPostService)
    {
        $this->clientSettingService = $clientSettingService;
        $this->clientAdvService = $clientAdvService;
        $this->clientCategoryService = $clientCategoryService;
        $this->clientProductService = $clientProductService;
        $this->clientPostService = $clientPostService;
    }

    public function homePage()
    {
        return $this->settingRepository->findFirst();
    }

    public function index($system = "")
    {
        try {
            $slug = "index";
            if (empty($slug)) return false;
            if ($system == "system") {
                return $this->indexSql($slug);
            } else {
                $file = Helpers::renderFileHtml($slug, $this->type);
                if (!Storage::disk("html_file")->exists($file)) {
                    return $this->indexSql($slug);
                }
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function indexSql($slug)
    {
        try {
            $this->setCommon();
            $data['setting'] = $this->setting;
            $data['common'] = Helpers::metaHead($data['setting']);
//            $data['slide'] = $this->clientAdvService->getListSlideShow();
            $data['link'] = $this->clientAdvService->getListLink();
//            $data['products'] = $this->clientProductService->getListHome(['limit' => 30]);
            $data['game'] = $this->clientProductService->getListByCate(['cate_multi' => $this->clientCategoryService->multiCate(2), 'limit' => 12]);
            $data['app'] = $this->clientProductService->getListByCate(['cate_multi' => $this->clientCategoryService->multiCate(3), 'limit' => 12]);
            $data['cat_game'] = $this->clientCategoryService->findById(2);
            $data['cat_app'] = $this->clientCategoryService->findById(3);
            $data['blog'] = $this->clientPostService->getListByCate(['cate_multi' => $this->clientCategoryService->multiCate(4), 'limit' => 6]);
//            $data['ads_home'] = $this->clientAdvService->getListAdsLimit(['limit' => 4]);
            $data['tophot'] = $this->clientProductService->getListChoose1(['limit' => 50]);
            $data['tophot2'] = $this->clientProductService->getListChoose3(['limit' => 12]);
            //$data['newpost'] = $this->clientPostService->getListNew();
            $data['page_home'] = true;

            $arr = ["", "_id", "_ph"];
            foreach ($arr as $row) {
                if (empty($row)) {
                    $_SESSION["lang"] = "";
                    $this->setCommon();
                    $data['common'] = Helpers::metaHead($data['setting']);
                    $html = view('clients::home.index', compact('data'))->render();
                    Helpers::renderHtml($slug, $this->type, $html);
                } else {
                    $_SESSION["lang"] = $row;
                    $this->setCommon();
                    $data['common'] = Helpers::metaHead($data['setting']);
                    $data['full_url'] = Helpers::checkLang(route("client.home"));
                    $html = view('clients::home.index', compact('data'))->render();
                    $find = '<a href="' . env('APP_URL');
                    $html = str_replace($find, '<a href="' . env('APP_URL') . "/" . str_replace("_", "", $row), $html);
                    $html = str_replace("/id/id/", "/id/", $html);
                    $html = str_replace("/ph/ph/", "/ph/", $html);
                    $html = str_replace(env('APP_URL') . "/search", env('APP_URL') . "/" . str_replace("_", "", $row) . "/search", $html);
                    Helpers::renderHtml("=" . $row . "=" . $slug, $this->type, $html);
                    $_SESSION["lang"] = "";
                }
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Page setCommon
     * @method GET
     */
    public function setCommon()
    {
        $this->setting = $this->clientSettingService->findFirst();
        View::share('data_common', [
            'logo' => $this->clientAdvService->findByLogo(),
            'setting' => $this->setting,
            'category_list' => $this->clientCategoryService->getListMenu(['multi' => 1])
        ]);
    }

}
