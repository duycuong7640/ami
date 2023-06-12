<?php

namespace Modules\Clients\Http\Controllers;

use App\Service\Cache\ProductCacheService;
use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\ClientPostService;
use App\Service\Clients\ClientProductService;
use App\Service\Clients\SettingService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Model\Post;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use LukeSnowden\GoogleShoppingFeed\Containers\GoogleShopping;
use Raulr\GooglePlayScraper\Scraper;

class ProductsController extends Controller
{

    private $clientSettingService;
    private $clientAdvService;
    private $clientCategoryService;
    private $clientProductService;
    private $clientPostService;
    public $type = "product";
    public $type_download = "product-download";
    public $type_download_last = "product-download-last";

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

    /**
     * Page show
     * @method GET
     */
    public function show($slug)
    {
        try {
            $data['detail'] = $this->clientProductService->findBySlug($slug);
            if (empty($data['detail']->id)) return false;
            $_SESSION['PRO_VIEWED'][$data['detail']->id] = $data['detail']->id;
            $this->setCommon();
            $data['common'] = Helpers::metaHead($data['detail']);
            $data['cate_parent'] = !empty($data['detail']->category_parent_id) ? $this->clientCategoryService->findById($data['detail']->category_parent_id) : [];
            $data['related'] = $this->clientProductService->getListRelated(['category_id' => $data['detail']->category_id]);
            return view('clients::products.show', compact('data'));
        } catch (\Exception $e) {Helpers::pre($e->getMessage());
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

    public function showSql($slug)
    {
        try {
            $this->productCacheService->show($slug);
            header("Refresh:0");
        } catch (\Exception $e) {
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }

    /**
     * Page showDownload
     * @method GET
     */
    public function showDownload($slug)
    {
        try {
            if (empty($slug)) abort(404);
            $lang_url = !empty($_SESSION["lang"]) ? "=" . $_SESSION["lang"] . "=" : "";
            $file = Helpers::renderFileHtml($lang_url . $slug, $this->type_download);
            if (!Storage::disk("html_file")->exists($file)) {
                abort(404);
                //$this->showDownloadSql($slug);
            } else {
                return File::get(public_path() . '/html/' . $file);
            }
        } catch (\Exception $e) {
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }

    public function showDownloadSql($slug)
    {
        try {
            $this->productCacheService->showDownload($slug);
            header("Refresh:0");
        } catch (\Exception $e) {
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }

    /**
     * Page showDownloadApp
     * @method GET
     */
    public function showDownloadApp($type, $slug)
    {
        try {
            if (empty($slug)) abort(404);
            $arr_type = explode("-", $type);
            $file_down = isset($arr_type[count($arr_type) - 1]) ? $arr_type[count($arr_type) - 1] : "";
            $data["down"] = strpos("-" . $type, "last-version") ? "last" : (strpos("-" . $type, "original-version") ? "original" : "");
            $data["file_down"] = $file_down;
            $key = $data["down"] . $file_down;
            if (empty($file_down) || !is_numeric($file_down) || !in_array($data["down"], ["last", "original"])) abort(404);

            $lang_url = !empty($_SESSION["lang"]) ? "=" . $_SESSION["lang"] . "=" : "";
            $file = Helpers::renderFileHtml($lang_url . $slug . "-" . $key, $this->type_download_last);
            if (!Storage::disk("html_file")->exists($file)) {
                abort(404);
                //$this->showDownloadAppSql($type, $slug);
            } else {
                return File::get(public_path() . '/html/' . $file);
            }
        } catch (\Exception $e) {
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }

    public function showDownloadAppSql($type, $slug)
    {
        try {
            $this->productCacheService->showDownloadApp($type, $slug);
            header("Refresh:0");
        } catch (\Exception $e) {
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }

    /**
     * Page feed
     * @method GET
     */
    public function feed()
    {
        try {
            $data['list'] = $this->clientProductService->getListAll(["limit" => 200]);

            GoogleShopping::title('Product Feed');
            GoogleShopping::link(asset('/'));
            GoogleShopping::description('Google Shopping Feed');

            foreach ($data['list'] as $row) {

                $item = GoogleShopping::createItem();
                $item->id($row->id);
                $item->title($row->title);
                if (!empty($row->price_root)) {
                    $item->price($row->price_root);
                    $item->sale_price($row->price);
                } else {
                    $item->price($row->price);
                }

                $item->description((strlen($row->description < 10) ? substr(strip_tags($row->content), 0, 200) : strip_tags($row->description)));
                $item->link(route('client.product.show', ['slug' => $row->slug . '-' . $row->id]));
                $item->image_link(\App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_product'));
//                $item->content($row->content);
                //$item->mpn($SKU);
//                $item->sale_price($salePrice);
//                $item->link($link);
//                $item->image_link($imageLink);
//                ...
//                ...F

                /** create a variant */
//                $variant = $item->variant();
//                $variant->size($variant::LARGE);
//                $variant->color('Red');

                /**
                 * One thing to note, if creating variants, delete the initial object after you've done,
                 * Google no longer needs it!
                 *
                 * $item->delete();
                 *
                 */

            }

// boolean value indicates output to browser
            GoogleShopping::asRss(true);

        } catch (\Exception $e) {
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }

}
