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

class CategoryCacheService
{

    private $clientSettingService;
    private $clientAdvService;
    private $clientCategoryService;
    private $clientProductService;
    private $clientPostService;
    private $setting;
    public $type = "categories";

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

    public function index($slug, $system = "")
    {
        try {
            if (empty($slug)) return false;
            if ($system = "system") {
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
            $data['category'] = $this->clientCategoryService->findBySlug($slug);
            if (empty($data['category']->id)) return false;
            $this->setCommon();
            $data['setting'] = $this->setting;
            $data['common'] = Helpers::metaHead($data['category']);
            $data['link'] = $this->clientAdvService->getListLink();
            $data['newpost'] = $this->clientPostService->getListByCate(['cate_multi' => $this->clientCategoryService->multiCate(3), 'limit' => 5]);
            $cateMulti = $this->clientCategoryService->multiCate($data['category']->id);

            $parentId = $this->clientCategoryService->getLastParentId(!empty($data['category']->parent_id) ? $data['category']->parent_id : $data['category']->id);
            $data['list_menu'] = $this->clientCategoryService->findListParentId($parentId);
            $url = 'class="page-link" href="' . env("APP_URL");//request()->url();
            $url_page = 'class="page-link" href="' . route("client.category.index", ["slug" => $slug]);

            if ($data['category']->type == 'product') {
                $data['list'] = $this->clientProductService->getListByCatePage(['cate_multi' => $cateMulti, 'limit' => 30, 'page' => 1]);

                $arr = ["", "_id", "_ph"];
                foreach ($arr as $row) {
                    if (empty($row)) {
                        $_SESSION["lang"] = "";
                        $this->setCommon();
                        $data['list_menu'] = $this->clientCategoryService->findListParentId($parentId);
                        $data['common'] = Helpers::metaHead($data['category']);
                        $html = view('clients::products.index', compact('data'))->render();
                        $html = str_replace($url, $url_page, $html);
                        Helpers::renderHtml($slug, $this->type, $html);
                    } else {
                        $_SESSION["lang"] = $row;
                        $this->setCommon();
                        $data['list_menu'] = $this->clientCategoryService->findListParentId($parentId);
                        $data['common'] = Helpers::metaHead($data['category']);
                        $html = view('clients::products.index', compact('data'))->render();
                        $html = str_replace($url, $url_page, $html);
                        $find = '<a href="' . env('APP_URL');
                        $html = str_replace($find, '<a href="' . env('APP_URL') . "/" . str_replace("_", "", $row), $html);
                        $html = str_replace("/id/id/", "/id/", $html);
                        $html = str_replace("/ph/ph/", "/ph/", $html);
                        Helpers::renderHtml("=" . $row . "=" . $slug, $this->type, $html);
                        $_SESSION["lang"] = "";
                    }
                }

                //page
                if (!empty($data['list']->lastPage())) {
                    $total = $data['list']->lastPage();
                    for ($i = 1; $i <= $total; $i++) {
                        $data['list'] = $this->clientProductService->getListByCatePage(['cate_multi' => $cateMulti, 'limit' => 30, 'page' => $i]);

                        $arr = ["", "_id", "_ph"];
                        foreach ($arr as $row) {
                            if (empty($row)) {
                                $_SESSION["lang"] = "";
                                $this->setCommon();
                                $data['list_menu'] = $this->clientCategoryService->findListParentId($parentId);
                                $data['common'] = Helpers::metaHead($data['category']);
                                $html = view('clients::products.index', compact('data'))->render();
                                $html = str_replace($url, $url_page, $html);
                                Helpers::renderHtml($slug . "-page" . $i . "-", $this->type, $html);
                            } else {
                                $_SESSION["lang"] = $row;
                                $this->setCommon();
                                $data['list_menu'] = $this->clientCategoryService->findListParentId($parentId);
                                $data['common'] = Helpers::metaHead($data['category']);
                                $html = view('clients::products.index', compact('data'))->render();
                                $html = str_replace($url, $url_page, $html);
                                $find = '<a href="' . env('APP_URL');
                                $html = str_replace($find, '<a href="' . env('APP_URL') . "/" . str_replace("_", "", $row), $html);
                                $html = str_replace("/id/id/", "/id/", $html);
                                $html = str_replace("/ph/ph/", "/ph/", $html);
                                $html = str_replace(env('APP_URL') . "/search", env('APP_URL') . "/" . str_replace("_", "", $row) . "/search", $html);
                                Helpers::renderHtml("=" . $row . "=" . $slug . "-page" . $i . "-", $this->type, $html);
                                $_SESSION["lang"] = "";
                            }
                        }

                    }
                }

                return true;
            } else {
                $data['list'] = $this->clientPostService->getListByCatePage(['cate_multi' => $cateMulti, 'limit' => 15, 'page' => 1]);
//                if(count($data['list']) == 1 && empty($_GET['page'])){
//                    return redirect(route('client.post.show', ['slug' => $data['list'][0]->slug]));
//                }


                $arr = ["", "_id", "_ph"];
                foreach ($arr as $row) {
                    if (empty($row)) {
                        $_SESSION["lang"] = "";
                        $this->setCommon();
                        $data['list_menu'] = $this->clientCategoryService->findListParentId($parentId);
                        $data['common'] = Helpers::metaHead($data['category']);
                        $html = view('clients::posts.index', compact('data'))->render();
                        $html = str_replace($url, $url_page, $html);
                        Helpers::renderHtml($slug, $this->type, $html);
                    } else {
                        $_SESSION["lang"] = $row;
                        $this->setCommon();
                        $data['list_menu'] = $this->clientCategoryService->findListParentId($parentId);
                        $data['common'] = Helpers::metaHead($data['category']);
                        $html = view('clients::posts.index', compact('data'))->render();
                        $html = str_replace($url, $url_page, $html);
                        $find = '<a href="' . env('APP_URL');
                        $html = str_replace($find, '<a href="' . env('APP_URL') . "/" . str_replace("_", "", $row), $html);
                        $html = str_replace("/id/id/", "/id/", $html);
                        $html = str_replace("/ph/ph/", "/ph/", $html);
                        $html = str_replace(env('APP_URL') . "/search", env('APP_URL') . "/" . str_replace("_", "", $row) . "/search", $html);
                        Helpers::renderHtml("=" . $row . "=" . $slug, $this->type, $html);
                        $_SESSION["lang"] = "";
                    }
                }

                //page
                if (!empty($data['list']->lastPage())) {
                    $total = $data['list']->lastPage();
                    for ($i = 1; $i <= $total; $i++) {
                        $data['list'] = $this->clientPostService->getListByCatePage(['cate_multi' => $cateMulti, 'limit' => 15, 'page' => $i]);

                        $arr = ["", "_id", "_ph"];
                        foreach ($arr as $row) {
                            if (empty($row)) {
                                $_SESSION["lang"] = "";
                                $this->setCommon();
                                $data['list_menu'] = $this->clientCategoryService->findListParentId($parentId);
                                $data['common'] = Helpers::metaHead($data['category']);
                                $html = view('clients::products.index', compact('data'))->render();
                                $html = str_replace($url, $url_page, $html);
                                Helpers::renderHtml($slug . "-page" . $i . "-", $this->type, $html);
                            } else {
                                $_SESSION["lang"] = $row;
                                $this->setCommon();
                                $data['list_menu'] = $this->clientCategoryService->findListParentId($parentId);
                                $data['common'] = Helpers::metaHead($data['category']);
                                $html = view('clients::products.index', compact('data'))->render();
                                $html = str_replace($url, $url_page, $html);
                                $find = '<a href="' . env('APP_URL');
                                $html = str_replace($find, '<a href="' . env('APP_URL') . "/" . str_replace("_", "", $row), $html);
                                $html = str_replace("/id/id/", "/id/", $html);
                                $html = str_replace("/ph/ph/", "/ph/", $html);
                                $html = str_replace(env('APP_URL') . "/search", env('APP_URL') . "/" . str_replace("_", "", $row) . "/search", $html);
                                Helpers::renderHtml("=" . $row . "=" . $slug . "-page" . $i . "-", $this->type, $html);
                                $_SESSION["lang"] = "";
                            }
                        }
                    }
                }

                return true;
            }
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
