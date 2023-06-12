<?php

namespace Modules\Admins\Http\Controllers;

use App\Helpers\Helpers;
use App\Helpers\ResponseHelpers;
use App\Service\Admins\CategoryService;
use App\Service\Admins\ProductService;
use App\Service\Cache\AllCacheService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;
use Modules\Admins\Http\Requests\Product\CreateRequest;
use Modules\Admins\Http\Requests\Product\EditRequest;

class ProductsController extends Controller
{

    private $categoryService;
    private $productService;
    private $allCacheService;
    private $type;
    public $html_type = "product";
    public $html_type_download = "product-download";
    public $html_type_download_last = "product-download-last";

    public function __construct(CategoryService $categoryService, ProductService $productService, AllCacheService $allCacheService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->allCacheService = $allCacheService;
        $this->type = [$this->categoryService::TYPE[1]];
    }

    /**
     * Category index
     * @method GET
     */
    public function index()
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.product.index.title'), __('admins::layer.product.index.title2')]);
            $data['list'] = $this->productService->getList(['limit' => 10]);
//            foreach ($data['list'] as $row){
//                $arr = [
//                    'title' => $row->title,
//                    'slug' => $row->slug.'-'.time(),
//                    'admin_id' => $row->admin_id,
//                    'category_id' => $row->category_id,
//                    'price' => $row->price,
//                    'description' => $row->description,
//                    'content' => $row->content,
//                    'thumbnail' => $row->thumbnail,
//                    'status' => $row->status,
//                    'type' => $row->type,
//                ];
//                $this->productService->create($arr);
//            }

            $data['category'] = $this->categoryService->getListMenu(['type' => $this->type, 'parent_id' => [(request()->has('category_id') ? request()->get('category_id') : '')]]);
            return view('admins::products.index', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }

    public function index_version()
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.product.index.title_version'), __('admins::layer.product.index.title2_version')]);
            $data['list'] = $this->productService->getListVersion(['limit' => 50]);
            return view('admins::products.index_version', ['data' => $data]);
        } catch (\Exception $e) {Helpers::pre($e->getMessage());
            abort('500');
        }
    }

    /**
     * Category add
     * @method GET
     */
    public function create()
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.product.add.title'), __('admins::layer.product.index.title2')]);
            $data['category'] = $this->categoryService->getListMenu(['type' => $this->type, 'multi' => true]);
            return view('admins::products.create', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Category store
     * @method POST
     */
    public function store(CreateRequest $request)
    {
        try {
            $_params = $request->all();
            $data = $this->productService->create($_params);
            if (!empty($data->id)) {
                $this->createCache();
//                return redirect(route('admin.product.edit', ["id" => $data->id]));
                return redirect(route('admin.product.index'));
            } else {
                $errors = new MessageBag(['error' => __('admins::layer.notify.fail')]);
                return back()->withInput($_params)->withErrors($errors);
            }
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admins::show');
    }

    /**
     * Category edit
     * @method GET
     */
    public function edit($id)
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.product.edit.title'), __('admins::layer.product.index.title2')]);
            $data['detail'] = $this->productService->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            $data['category'] = $this->categoryService->getListMenu(['type' => $this->type, 'parent_id' => [$data['detail']->category_id], 'multi' => true]);
            return view('admins::products.edit', ['data' => $data]);
        } catch (\Exception $e) {
            return !empty($e->getMessage()) ? abort('500') : abort(404);
        }
    }

    /**
     * Category update
     * @method POST
     */
    public function update(EditRequest $request, $id)
    {
        try {
            $data['detail'] = $this->productService->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            $_params = $request->all();
            if ($this->productService->update($_params, $id)) {
                $this->createCache();
                session()->flash('success', __('admins::layer.notify.success'));
                return redirect(route('admin.product.index', ['page' => !empty($_GET['page']) ? $_GET['page'] : 1]));
//                return redirect(route('admin.product.edit', ['id' => $data['detail']->id]));
            } else {
                $errors = new MessageBag(['error' => __('admins::layer.notify.fail')]);
                return back()->withInput($_params)->withErrors($errors);
            }
        } catch (\Exception $e) {
            return !empty($e->getMessage()) ? abort('500') : abort(404);
        }
    }

    /**
     * Product load data
     * @method POST
     */
    public function loadData()
    {
        try {
            if (!empty(\request()->get("key"))) {
                $key = \request()->get("key");

//                $gplay = new \Nelexa\GPlay\GPlayApps($defaultLocale = 'en_US', $defaultCountry = 'us');
//                $info = $gplay->getAppInfo($key);
//                $info = [
//                    "play_cover" => $info->getCover()->getUrl(),
//                    "play_image" => $info->getIcon()->getUrl(),
//                    "name" => $info->getName(),
//                    "updated" => $info->getUpdated()->getTimestamp(),
//                    "compatible_with" => $info->getAndroidVersion(),
//                    "version" => $info->getAppVersion(),
//                    "size" => $info->getSize(),
//                    "mod" => "",
//                    "develop" => $info->getDeveloper()->getName(),
//                    "url" => $info->getUrl(),
//                ];
                $info = Helpers::getInfoAppId($key);

                return ResponseHelpers::showResponse($info);
            }
            return ResponseHelpers::serverErrorResponse();
        } catch (\Exception $e) {
            return ResponseHelpers::serverErrorResponse([]);
        }
    }

    /**
     * Category status
     * @method GET
     */
    public function status($id, $status)
    {
        try {
            if ($this->productService->updateStatus($id, $status)) {
                $this->createCache();
                session()->flash('success', __('admins::layer.notify.success'));
            } else {
                session()->flash('error', __('admins::layer.notify.fail'));
            }
            return back();
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function actionIndex()
    {
        try {
            $data = \request()->all();
            if (empty($data['check']) || empty($data['action'])) {
                session()->flash('error', __('admins::layer.notify.fail'));
            } else {
                $flag = true;
                if ($data['action'] == 1) {
                    $flag = $this->productService->destroyAll($data);
                }

                if ($flag) {
                    session()->flash('success', __('admins::layer.notify.success'));
                } else {
                    session()->flash('error', __('admins::layer.notify.fail'));
                }
            }
            return back();
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            //delete html
            $data['detail'] = $this->productService->findById($id);
            Helpers::renderHtmlDelete($data['detail']->slug, $this->html_type);
            $arr = ["_id", "_ph"];
            foreach ($arr as $row) {
                Helpers::renderHtmlDelete("=" . $row . "=" . $data['detail']->slug, $this->html_type);
            }

            Helpers::renderHtmlDelete($data['detail']->slug, $this->html_type_download);
            foreach ($arr as $row) {
                Helpers::renderHtmlDelete("=" . $row . "=" . $data['detail']->slug, $this->html_type_download);
            }

            $files = explode("|", $data['detail']->file_multi);
            $arr = [];
            foreach ($files as $r) {
                if (!empty($r)) $arr[] = $r;
            }

            $file_apps = explode("|", $data['detail']->app_name_multi);
            $arr_appname = [];
            foreach ($file_apps as $r) {
                if (!empty($r)) $arr_appname[] = $r;
            }
            $this->deleteDownloadHtml("original-version-1", $data);

            foreach($arr as $k => $r) {
                $this->deleteDownloadHtml("last-version-" . ($k + 1), $data);
            }

            //delete sql
            if ($this->productService->destroy($id)) {
                $this->createCache();
                session()->flash('success', __('admins::layer.notify.success'));
            } else {
                session()->flash('error', __('admins::layer.notify.fail'));
            }
            return back();
        } catch (\Exception $e) {
            abort('500');
        }
    }

    public function deleteDownloadHtml($type, $data){
        $arr_type = explode("-", $type);
        $file_down = isset($arr_type[count($arr_type) - 1]) ? $arr_type[count($arr_type) - 1] : "";
        $data["down"] = strpos("-" . $type, "last-version") ? "last" : (strpos("-" . $type, "original-version") ? "original" : "");
        $data["file_down"] = $file_down;
        $key = $data["down"].$file_down;
        if (empty($file_down) || !is_numeric($file_down) || !in_array($data["down"], ["last", "original"])) abort(404);

        $arr = ["", "_id", "_ph"];
        foreach ($arr as $row) {
            if (empty($row)) {
                Helpers::renderHtmlDelete($data['detail']->slug."-".$key, $this->html_type_download_last);
            } else {
                Helpers::renderHtmlDelete("=" . $row . "=" . $data['detail']->slug."-".$key, $this->html_type_download_last);
            }
        }

    }

    public function createCache() {
        $this->allCacheService->createCache();
    }

}
