<?php

namespace App\Service\Cache;

use App\Helpers\Helpers;
use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\ClientPostService;
use App\Service\Clients\ClientProductService;
use App\Service\Clients\SettingService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class PostCacheService
{

    private $clientSettingService;
    private $clientAdvService;
    private $clientCategoryService;
    private $clientProductService;
    private $clientPostService;
    private $setting;
    public $type = "posts";

    public function __construct(SettingService $clientSettingService,
                                AdvertisementService $clientAdvService,
                                ClientCategoryService $clientCategoryService,
                                ClientProductService $clientProductService,
                                ClientPostService $clientPostService
    )
    {
        $this->clientSettingService = $clientSettingService;
        $this->clientAdvService = $clientAdvService;
        $this->clientCategoryService = $clientCategoryService;
        $this->clientProductService = $clientProductService;
        $this->clientPostService = $clientPostService;
    }

    /**
     * Page show
     * @method GET
     */
    public function show($slug, $system = "")
    {
        try {
            if (empty($slug)) return false;
            if($system == "system"){
                return $this->showSql($slug);
            }else {
                $file = Helpers::renderFileHtml($slug, $this->type);
                if (!Storage::disk("html_file")->exists($file)) {
                    return $this->showSql($slug);
                }
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function showSql($slug)
    {
        try {
            $data['detail'] = $this->clientPostService->findBySlug($slug);
            if (empty($data['detail']->id)) return false;
            $this->setCommon();
            $data['link'] = $this->clientAdvService->getListLink();
            $data['setting'] = $this->setting;
            $data['common'] = Helpers::metaHead($data['detail']);
            $data['cate_parent'] = !empty($data['detail']->category_parent_id) ? $this->clientCategoryService->findById($data['detail']->category_parent_id) : [];
            $data['related'] = $this->clientPostService->getListRelated(['category_id' => $data['detail']->category_id, 'id' => $data['detail']->id]);
            $data['newpost'] = $this->clientPostService->getListByCate(['cate_multi' => $this->clientCategoryService->multiCate(3), 'limit' => 5]);
            $data['regex'] = Helpers::hyperlinkContentRegex($data['detail']->content);

            $data['regex'] = Helpers::hyperlinkContentRegex($data['detail']->content);
            $tocContainer = Helpers::split_head($data['detail']->content);
            $data['ftoc'] = false;
            if ($tocContainer != "") {
                $data['ftoc'] = true;
            }
            $data["show"] = 1;

            $arr = ["", "_id", "_ph"];
            foreach ($arr as $row) {
                if (empty($row)) {
                    $_SESSION["lang"] = "";
                    $this->setCommon();
                    $data['common'] = Helpers::metaHead($data['detail']);
                    $html = view('clients::posts.show', compact('data'))->render();
                    Helpers::renderHtml($slug, $this->type, $html);
                } else {
                    $_SESSION["lang"] = $row;
                    $this->setCommon();
                    $data['common'] = Helpers::metaHead($data['detail']);
                    $html = view('clients::posts.show', compact('data'))->render();
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
            'category_list' => $this->clientCategoryService->getListMenu(['multi' => 1]),
            'top_products' => $this->clientProductService->getListHome(['limit' => 8])
        ]);
    }

}
