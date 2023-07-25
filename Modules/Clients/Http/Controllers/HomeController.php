<?php

namespace Modules\Clients\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\Cache\HomePageService;
use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\ClientPostService;
use App\Service\Clients\ClientProductService;
use App\Service\Clients\SettingService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    private $clientSettingService;
    private $clientAdvService;
    private $clientCategoryService;
    private $clientProductService;
    private $clientPostService;
    public $type = "home";

    public function __construct(SettingService $clientSettingService,
                                AdvertisementService $clientAdvService,
                                ClientCategoryService $clientCategoryService,
                                ClientProductService $clientProductService,
                                ClientPostService $clientPostService)
    {
        $this->clientSettingService = $clientSettingService;
        $this->clientCategoryService = $clientCategoryService;
        $this->clientAdvService = $clientAdvService;
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

                $route = "";
                switch ($_SESSION["lang"]) {
//                    case "_es":
//                        $route = "es";
//                        break;
//                    case "_pt":
//                        $route = "pt";
//                        break;
                    case "_id":
                        $route = "id";
                        break;
                    case "_ph":
                        $route = "ph";
                        break;
                    default:
                        $route = "";
                        break;
                }

//                if (strpos($str, "/es")) {
//                    $str = str_replace("/es", "/", $str);
//                }
//                if (strpos($str, "/pt")) {
//                    $str = str_replace("/pt", "/", $str);
//                }
                if (strpos($str, "/id")) {
                    $str = str_replace("/id", "/", $str);
                }
                if (strpos($str, "/ph")) {
                    $str = str_replace("/ph", "/", $str);
                }

                //$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                header('Location: ' . $str . $route);
                exit;
            } else {
                $_SESSION["lang"] = "";
            }

        } else {
            if (empty($_SESSION["lang"])) $_SESSION["lang"] = "";
        }
    }

    /**
     * Page Home
     * @method GET
     */
    public function index()
    {
        try {
            $this->setCommon();
            $data['setting'] = $this->clientSettingService->findFirst();
            $data['common'] = Helpers::metaHead($data['setting']);
            $data['drag_home'] = $this->clientAdvService->findFourth();
            $data['category_products'] = $this->clientCategoryService->findListParentId(2);
            $data['home_new'] = $this->clientCategoryService->findById(3);
            $data['truso'] = $this->clientCategoryService->findById(4);
            $data['ttsk'] = $this->clientCategoryService->findById(15);
            $data['ttsk_list'] = $this->clientPostService->getListByCategoryNotPaginateEvent(['cate_multi' => $this->clientCategoryService->multiCate(15), 'limit' => 30]);
            $data['home_new_cate'] = $this->clientCategoryService->findListParentId(3);
            $data["home_new_cate_post"] = [];
            foreach ($data['home_new_cate'] as $row) {
                $data["home_new_cate_post"][$row->id] = $this->clientPostService->getListByCategoryNotPaginate(['cate_multi' => $this->clientCategoryService->multiCate($row->id), 'limit' => 6]);
            }
            return view('clients::home.index', compact('data'));
        } catch (\Exception $e) {
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }

    public function testStripe(){
        Log::info('Log:' . date('d/m/Y') . '--' . @file_get_contents('php://input'));
        die;
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
            'category_list_footer' => $this->clientCategoryService->findListParentId(18)
        ]);
    }
}
