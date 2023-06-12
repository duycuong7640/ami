<?php

namespace App\Service\Cache;

use App\Helpers\Helpers;
use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\ClientPostService;
use App\Service\Clients\ClientProductService;
use App\Service\Clients\SettingService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProductCacheService
{

    private $clientSettingService;
    private $clientAdvService;
    private $clientCategoryService;
    private $clientProductService;
    private $clientPostService;
    private $setting;
    public $type = "product";
    public $type_download = "product-download";
    public $type_download_last = "product-download-last";

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
            $data['detail'] = $this->clientProductService->findBySlug($slug);
            if (empty($data['detail']->id)) return false;
            $this->setCommon();
            $data['setting'] = $this->setting;
//            $row = $data['detail'];
            $data['link'] = $this->clientAdvService->getListLink();
            $data['detail']->title3 = $data['detail']->title;
            $data['detail']->title3_es = $data['detail']->title_es;
            $data['detail']->title3_pt = $data['detail']->title_pt;
            $data['detail']->title3_id = $data['detail']->title_id;
            $data['detail']->title3_ph = $data['detail']->title_ph;
            $data['detail']->title = $data['detail']->title . " " . $data['detail']->type_game . " " . $data['detail']->play_last_version . " (" . $data['detail']->mod_d . ")";
            $data['detail']->title_es = $data['detail']->title_es . " " . (!empty($data['detail']->type_game_es) ? $data['detail']->type_game_es : "") . " " . $data['detail']->play_last_version . " (" . (!empty($data['detail']->mod_d_es) ? $data['detail']->mod_d_es : "") . ")";
            $data['detail']->title_pt = $data['detail']->title_pt . " " . (!empty($data['detail']->type_game_pt) ? $data['detail']->type_game_pt : "") . " " . $data['detail']->play_last_version . " (" . (!empty($data['detail']->mod_d_pt) ? $data['detail']->mod_d_pt : "") . ")";
            $data['detail']->title_id = $data['detail']->title_id . " " . (!empty($data['detail']->type_game_id) ? $data['detail']->type_game_id : "") . " " . $data['detail']->play_last_version . " (" . (!empty($data['detail']->mod_d_id) ? $data['detail']->mod_d_id : "") . ")";
            $data['detail']->title_ph = $data['detail']->title_ph . " " . (!empty($data['detail']->type_game_ph) ? $data['detail']->type_game_ph : "") . " " . $data['detail']->play_last_version . " (" . (!empty($data['detail']->mod_d_ph) ? $data['detail']->mod_d_ph : "") . ")";
            $data['detail']->ts = 1;
            $data['common'] = Helpers::metaHead($data['detail']);
//            $data['newpost'] = $this->clientPostService->getListByCate(['cate_multi' => $this->clientCategoryService->multiCate(3), 'limit' => 5]);
            $data['cate_parent'] = !empty($data['detail']->category_parent_id) ? $this->clientCategoryService->findById($data['detail']->category_parent_id) : [];
            $data['related'] = $this->clientProductService->getListRelated(['category_id' => $data['detail']->category_id]);
//            $gplay = new \Nelexa\GPlay\GPlayApps($defaultLocale = 'en_US', $defaultCountry = 'us');
//            $info = $gplay->getAppInfo($data['detail']->code);
//            $data['infoplay'] = [
//                "play_cover" => $info->getCover()->getUrl(),
//                "play_image" => $info->getIcon()->getUrl(),
//                "name" => $info->getName(),
//                "updated" => $info->getUpdated()->getTimestamp(),
//                "compatible_with" => $info->getAndroidVersion(),
//                "version" => $info->getAppVersion(),
//                "size" => $info->getSize(),
//                "mod" => "",
//                "develop" => $info->getDeveloper()->getName(),
//                "url" => $info->getUrl(),
//            ];

//            Helpers::pre($data['infoplay']);

            $data['regex'] = Helpers::hyperlinkContentRegex($data['detail']->content);
            $tocContainer = Helpers::split_head($data['detail']->content);
            $data['ftoc'] = false;
            if ($tocContainer != "") {
                $data['ftoc'] = true;
            }
            $data["comment"] = DB::table("comments")->where("status", 1)->where("post_id", $data['detail']->id)->orderByDesc("id")->limit(20)->get();
            $data["show"] = 1;

            $arr = ["", "_id", "_ph"];
            foreach ($arr as $row) {
                if (empty($row)) {
                    $_SESSION["lang"] = "";
                    $this->setCommon();
                    $data['common'] = Helpers::metaHead($data['detail']);
                    $html = view('clients::products.show', compact('data'))->render();
                    Helpers::renderHtml($data['detail']->slug, $this->type, $html);
                } else {
                    $_SESSION["lang"] = $row;
                    $this->setCommon();
                    $data['common'] = Helpers::metaHead($data['detail']);
                    $html = view('clients::products.show', compact('data'))->render();
                    $find = '<a href="' . env('APP_URL');
                    $html = str_replace($find, '<a href="' . env('APP_URL') . "/" . str_replace("_", "", $row), $html);
                    $html = str_replace("/id/id/", "/id/", $html);
                    $html = str_replace("/ph/ph/", "/ph/", $html);
                    $html = str_replace(env('APP_URL') . "/search", env('APP_URL') . "/" . str_replace("_", "", $row) . "/search", $html);
                    Helpers::renderHtml("=" . $row . "=" . $data['detail']->slug, $this->type, $html);
                    $_SESSION["lang"] = "";
                }
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Page showDownload
     * @method GET
     */
    public function showDownload($slug, $system = "")
    {
        try {
            if (empty($slug)) return false;
            if($system == "system"){
                return $this->showDownloadSql($slug);
            }else {
                $file = Helpers::renderFileHtml($slug, $this->type_download);
                if (!Storage::disk("html_file")->exists($file)) {
                    return $this->showDownloadSql($slug);
                }
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function showDownloadSql($slug)
    {
        try {
//            $id = Helpers::renderID($slug);
            $data['detail'] = $this->clientProductService->findBySlug($slug);
            if (empty($data['detail']->id)) return false;
            $this->setCommon();
            $data['link'] = $this->clientAdvService->getListLink();
            $data['setting'] = $this->setting;
            $data['detail']->title3 = $data['detail']->title;
            $data['detail']->title3_es = $data['detail']->title_es;
            $data['detail']->title3_pt = $data['detail']->title_pt;
            $data['detail']->title3_id = $data['detail']->title_id;
            $data['detail']->title = $data['detail']->title . " " . $data['detail']->type_game . " " . $data['detail']->play_last_version . " (" . $data['detail']->mod_d . ")";
            $data['detail']->title_es = $data['detail']->title_es . " " . $data['detail']->type_game_es . " " . $data['detail']->play_last_version . " (" . $data['detail']->mod_d_es . ")";
            $data['detail']->title_pt = $data['detail']->title_pt . " " . $data['detail']->type_game_pt . " " . $data['detail']->play_last_version . " (" . $data['detail']->mod_d_pt . ")";
            $data['detail']->title_id = $data['detail']->title_id . " " . $data['detail']->type_game_id . " " . $data['detail']->play_last_version . " (" . $data['detail']->mod_d_id . ")";
            $data['detail']->ts = 1;
            $data['common'] = Helpers::metaHead($data['detail']);
            $data['cate_parent'] = !empty($data['detail']->category_parent_id) ? $this->clientCategoryService->findById($data['detail']->category_parent_id) : [];
            $data['related'] = $this->clientProductService->getListRelated(['category_id' => $data['detail']->category_id]);

            $arr = ["", "_id", "_ph"];
            foreach ($arr as $row) {
                if (empty($row)) {
                    $_SESSION["lang"] = "";
                    $this->setCommon();
                    $data['common'] = Helpers::metaHead($data['detail']);
                    $html = view('clients::products.showDownload', compact('data'))->render();
                    Helpers::renderHtml($data['detail']->slug, $this->type_download, $html);
                } else {
                    $_SESSION["lang"] = $row;
                    $this->setCommon();
                    $data['common'] = Helpers::metaHead($data['detail']);
                    $html = view('clients::products.showDownload', compact('data'))->render();
                    $find = '<a href="' . env('APP_URL');
                    $html = str_replace($find, '<a href="' . env('APP_URL') . "/" . str_replace("_", "", $row), $html);
                    $html = str_replace("/id/id/", "/id/", $html);
                    $html = str_replace("/ph/ph/", "/ph/", $html);
                    $html = str_replace(env('APP_URL') . "/search", env('APP_URL') . "/" . str_replace("_", "", $row) . "/search", $html);
                    Helpers::renderHtml("=" . $row . "=" . $data['detail']->slug, $this->type_download, $html);
                    $_SESSION["lang"] = "";
                }
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Page showDownloadApp
     * @method GET
     */
    public function showDownloadApp($type, $slug, $system = "")
    {
        try {
            if (empty($slug)) return false;
            if($system == "system"){
                return $this->showDownloadAppSql($type, $slug);
            }else {
                $file = Helpers::renderFileHtml($slug, $this->type_download_last);
                if (!Storage::disk("html_file")->exists($file)) {
                    return $this->showDownloadAppSql($type, $slug);
                }
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function showDownloadAppSql($type, $slug)
    {
        try {
            $this->setCommon();
            $arr_type = explode("-", $type);
            $file_down = isset($arr_type[count($arr_type) - 1]) ? $arr_type[count($arr_type) - 1] : "";
            $data["down"] = strpos("-" . $type, "last-version") ? "last" : (strpos("-" . $type, "original-version") ? "original" : "");
            $data["file_down"] = $file_down;
            $key = $data["down"].$file_down;
            if (empty($file_down) || !is_numeric($file_down) || !in_array($data["down"], ["last", "original"])) abort(404);
            $data['link'] = $this->clientAdvService->getListLink();
            //            $id = Helpers::renderID($slug);
            $data['detail'] = $this->clientProductService->findBySlug($slug);
            if (empty($data['detail']->id)) return false;
            $data['setting'] = $this->setting;
            $data['detail']->title3 = $data['detail']->title;
            $data['detail']->title3_es = $data['detail']->title_es;
            $data['detail']->title3_pt = $data['detail']->title_pt;
            $data['detail']->title3_id = $data['detail']->title_id;
            $data['detail']->title = $data['detail']->title . " " . $data['detail']->type_game . " " . $data['detail']->play_last_version . " (" . $data['detail']->mod_d . ")";
            $data['detail']->title_es = $data['detail']->title_es . " " . $data['detail']->type_game_es . " " . $data['detail']->play_last_version . " (" . $data['detail']->mod_d_es . ")";
            $data['detail']->title_pt = $data['detail']->title_pt . " " . $data['detail']->type_game_pt . " " . $data['detail']->play_last_version . " (" . $data['detail']->mod_d_pt . ")";
            $data['detail']->title_id = $data['detail']->title_id . " " . $data['detail']->type_game_id . " " . $data['detail']->play_last_version . " (" . $data['detail']->mod_d_id . ")";
            $data['detail']->ts = 1;
            $data['common'] = Helpers::metaHead($data['detail']);
            $data['cate_parent'] = !empty($data['detail']->category_parent_id) ? $this->clientCategoryService->findById($data['detail']->category_parent_id) : [];
            $data['related'] = $this->clientProductService->getListRelated(['category_id' => $data['detail']->category_id]);

            $arr = ["", "_id", "_ph"];
            foreach ($arr as $row) {
                if (empty($row)) {
                    $_SESSION["lang"] = "";
                    $this->setCommon();
                    $data['common'] = Helpers::metaHead($data['detail']);
                    $html = view('clients::products.showDownloadApp', compact('data'))->render();
                    Helpers::renderHtml($data['detail']->slug."-".$key, $this->type_download_last, $html);
                } else {
                    $_SESSION["lang"] = $row;
                    $this->setCommon();
                    $data['common'] = Helpers::metaHead($data['detail']);
                    $html = view('clients::products.showDownloadApp', compact('data'))->render();
                    $find = '<a href="' . env('APP_URL');
                    $html = str_replace($find, '<a href="' . env('APP_URL') . "/" . str_replace("_", "", $row), $html);
                    $html = str_replace("/id/id/", "/id/", $html);
                    $html = str_replace("/ph/ph/", "/ph/", $html);
                    $html = str_replace(env('APP_URL') . "/search", env('APP_URL') . "/" . str_replace("_", "", $row) . "/search", $html);
                    Helpers::renderHtml("=" . $row . "=" . $data['detail']->slug."-".$key, $this->type_download_last, $html);
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
