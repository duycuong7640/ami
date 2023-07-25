<?php

namespace Modules\Clients\Http\Controllers;

use App\Service\Cache\PostCacheService;
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

class PostsController extends Controller
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
                                ClientPostService $clientPostService)
    {
        $this->clientSettingService = $clientSettingService;
        $this->clientCategoryService = $clientCategoryService;
        $this->clientAdvService = $clientAdvService;
        $this->clientProductService = $clientProductService;
        $this->clientPostService = $clientPostService;

        if (isset($_GET["lang"])) {
            if (in_array($_GET["lang"], ["", "_en"])) {
                $_SESSION["lang"] = $_GET["lang"];

                $str = str_replace("?lang=_en", "", $_SERVER["HTTP_REFERER"]);
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
                    case "_en":
                        $route = "/en";
                        break;
                    default:
                        $route = "";
                        break;
                }

//                if(strpos("1".$strrep, "/es")){
//                    $str = str_replace("/es", $route, $strrep);
//                }elseif(strpos("1".$strrep, "/pt")){
//                    $str = str_replace("/pt", $route, $strrep);
//                }else
                if (strpos("1" . $strrep, "/en")) {
                    $str = str_replace("/en", $route, $strrep);
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

    /**
     * Page show
     * @method GET
     */
    public function show($slug)
    {
        try {
            $data['detail'] = $this->clientPostService->findBySlug($slug);
            if (empty($data['detail']->id)) return false;
            $this->setCommon();
            $data['common'] = Helpers::metaHead($data['detail']);
            $data['truso'] = $this->clientCategoryService->findById(4);
            $data['cate_parent'] = !empty($data['detail']->category_parent_id) ? $this->clientCategoryService->findById($data['detail']->category_parent_id) : [];
            $data['adv1'] = $this->clientAdvService->findAdv1();
            $data['adv2'] = $this->clientAdvService->findAdv2();

            $data['newpost'] = $this->clientPostService->getListByCate(['cate_multi' => $this->clientCategoryService->multiCate(3), 'limit' => 5]);
            if($data['detail']->type == 'new_event'){
                $data['related'] = $this->clientPostService->getListRelatedEvent(['category_id' => $data['detail']->category_id, 'id' => $data['detail']->id]);
                return view('clients::posts.event.show', compact('data'));
            }
            $data['related'] = $this->clientPostService->getListRelated(['category_id' => $data['detail']->category_id, 'id' => $data['detail']->id]);
            return view('clients::posts.show', compact('data'));
        } catch (\Exception $e) {
            if (empty($e->getMessage())) abort(404); else abort('500');
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
            'category_list_footer' => $this->clientCategoryService->findListParentId(18)
        ]);
    }

}
