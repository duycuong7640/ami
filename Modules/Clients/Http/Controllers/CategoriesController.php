<?php

namespace Modules\Clients\Http\Controllers;

use App\Service\Cache\CategoryCacheService;
use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\ClientPostService;
use App\Service\Clients\ClientProductService;
use App\Service\Clients\SettingService;
use Illuminate\Routing\Controller;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class CategoriesController extends Controller
{

    private $categoryCacheService;
    private $clientSettingService;
    private $clientAdvService;
    private $clientCategoryService;
    private $clientProductService;
    private $clientPostService;
    private $setting;
    public $type = "categories";

    public function __construct(CategoryCacheService $categoryCacheService,
                                SettingService $clientSettingService,
                                AdvertisementService $clientAdvService,
                                ClientCategoryService $clientCategoryService,
                                ClientProductService $clientProductService,
                                ClientPostService $clientPostService)
    {
        $this->categoryCacheService = $categoryCacheService;
        $this->clientSettingService = $clientSettingService;
        $this->clientAdvService = $clientAdvService;
        $this->clientCategoryService = $clientCategoryService;
        $this->clientProductService = $clientProductService;
        $this->clientPostService = $clientPostService;

        if (isset($_GET["lang"])) {
            if (in_array($_GET["lang"], ["", "_id", "_ph"])) {
                $_SESSION["lang"] = $_GET["lang"];

                $str = str_replace("?lang=_es", "", $_SERVER["HTTP_REFERER"]);
                $str = str_replace("?lang=_pt", "", $str);
                $str = str_replace("?lang=_id", "", $str);
                $str = str_replace("?lang=_ph", "", $str);
                $str = str_replace("?lang=", "", $str);

                if (env("ENVIROMENT") == "dev") {
                    $actual_link = "http://$_SERVER[HTTP_HOST]";
                } else {
                    $actual_link = "https://$_SERVER[HTTP_HOST]";
                }

                $strrep = str_replace($actual_link, "", $str);
                $ex = explode("/", $strrep);
                $rt = !empty($ex[1]) ? $ex[1] : "";

                $route = "";
                switch ($_SESSION["lang"]) {
//                    case "_es":
//                        $route = "/es";
//                        break;
//                    case "_pt":
//                        $route = "/pt";
//                        break;
                    case "_id":
                        $route = "/id";
                        break;
                    case "_ph":
                        $route = "/ph";
                        break;
                    default:
                        $route = "";
                        break;
                }

//                if (strpos("1" . $strrep, "/es")) {
//                    $str = str_replace("/es", $route, $strrep);
//                } elseif (strpos("1" . $strrep, "/pt")) {
//                    $str = str_replace("/pt", $route, $strrep);
//                } else
                if (strpos("1" . $strrep, "/id")) {
                    $str = str_replace("/id", $route, $strrep);
                } elseif (strpos("1" . $strrep, "/ph")) {
                    $str = str_replace("/ph", $route, $strrep);
                } else {
                    $str = $route . $strrep;
                }
                $str = $actual_link . $str;

                header('Location: ' . $str);
                exit;
            } else {
                $_SESSION["lang"] = "";
            }

        } else {
            if (empty($_SESSION["lang"])) $_SESSION["lang"] = "";
        }
    }

    public function index($slug)
    {
        try {
            $data['category'] = $this->clientCategoryService->findBySlug($slug);
            if (empty($data['category']->id)) return false;
            $this->setCommon();
            $data['common'] = Helpers::metaHead($data['category']);

            // new_about_ami
            switch ($data["category"]->type) {
                case 'new_about_ami':
                    $data['fixone'] = $this->clientAdvService->findFixOne();
                    $data['fixtwo'] = $this->clientAdvService->findFixTwo();
                    $data['list'] = $this->clientPostService->getListByCateAmi(['cate_multi' => [$data['category']->id], 'limit' => 100]);
                    return view('clients::posts.ami.about', compact('data'));
                case 'new_distributor':
                    $data['list'] = $this->clientPostService->getListByCateAmi(['cate_multi' => [$data['category']->id], 'limit' => 100]);
                    return view('clients::posts.ami.distributor', compact('data'));
                case 'new_manager_ami':
                    $data['fixtthree'] = $this->clientAdvService->findFixThree();
                    $data['list'] = $this->clientPostService->getListByCateAmi(['cate_multi' => [$data['category']->id], 'limit' => 100]);
                    return view('clients::posts.ami.manager', compact('data'));
                case 'new':
                    $data['cate'] = $this->clientCategoryService->findListParentId($data['category']->id);
                    $data['newpost'] = $this->clientPostService->getListByCate(['cate_multi' => $this->clientCategoryService->multiCate($data['category']->id), 'limit' => 500]);
                    if (count($data['cate']) > 0) {
                        return view('clients::posts.index_category', compact('data'));
                    } else {
                        return view('clients::posts.index', compact('data'));
                    }
                case 'product':
                    $data['pro_viewed'] = !empty($_SESSION['PRO_VIEWED']) ? $this->clientProductService->findViewed($_SESSION['PRO_VIEWED']) : [];
                    $data['cate'] = $this->clientCategoryService->findListParentId(2);
                    $data['newpost'] = $this->clientProductService->getListByCate(['cate_multi' => $this->clientCategoryService->multiCate($data['category']->id), 'limit' => 500, 'filter' => !empty(request()->type) ? request()->type : '']);
                    return view('clients::products.index', compact('data'));
                case 'new_location':
                    $data['newpost'] = $this->clientPostService->getListByCateLocaltion(['cate_multi' => $this->clientCategoryService->multiCate($data['category']->id), 'limit' => 100]);
                    return view('clients::posts.location.location', compact('data'));
                default:
                    break;
            }
        } catch (\Exception $e) {
            Helpers::pre($e->getMessage());
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }

    public function search()
    {
        try {
            $this->setCommon();
            $data['setting'] = $this->setting;
            $data['common'] = Helpers::metaHead($data['setting']);
//            $data['newpost'] = $this->clientPostService->getListByCate(['cate_multi' => $this->clientCategoryService->multiCate(3), 'limit' => 5]);
            $data['search_title'] = !empty($_GET['key']) ? 'Tiếp tục mua hàng' : Helpers::langDefine('Search');
            $keyword = !empty($_GET['keyword']) ? $_GET['keyword'] : '';
            $data['list'] = $this->clientProductService->getListByCateSearch(['keyword' => $keyword, 'limit' => 20]);
//            $data['list_post'] = $this->clientPostService->getListByCateSearch(['keyword' => $keyword, 'limit' => 8]);

            return view('clients::products.index', ['data' => $data]);
        } catch (\Exception $e) {
            Helpers::pre($e->getMessage());
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }

    public function setCommon()
    {
        $this->setting = $this->clientSettingService->findFirst();
        View::share('data_common', [
            'logo' => $this->clientAdvService->findByLogo(),
            'setting' => $this->setting,
            'category_list' => $this->clientCategoryService->getListMenu(['multi' => 1]),
            'top_products' => $this->clientProductService->getListHome(['limit' => 8]),
            'category_list_footer' => $this->clientCategoryService->findListParentId(18)
        ]);
    }
}
