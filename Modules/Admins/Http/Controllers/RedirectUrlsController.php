<?php

namespace Modules\Admins\Http\Controllers;

use App\Helpers\Helpers;
use App\Model\RedirectUrl;
use App\Service\Admins\RedirectUrlService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Modules\Admins\Http\Requests\RedirectUrl\CreateRequest;
use Modules\Admins\Http\Requests\RedirectUrl\EditRequest;

class RedirectUrlsController extends Controller
{
    private $service;
    private $type;

    public function __construct(RedirectUrlService $service)
    {
        $this->service = $service;
        View::share('type_redirect', [301, 302]);
    }

    /**
     * Category index
     * @method GET
     */
    public function index()
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.redirect.index.title'), __('admins::layer.redirect.index.title2')]);
            $data['list'] = $this->service->getList(['limit' => 20, 'type' => $this->type]);
            Helpers::saveJsonRedirect();
            return view('admins::redirectUrls.index', ['data' => $data]);
        } catch (\Exception $e) {
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
            $data['common'] = Helpers::titleAction([__('admins::layer.redirect.add.title'), __('admins::layer.redirect.index.title2')]);
            return view('admins::redirectUrls.create', ['data' => $data]);
        } catch (\Exception $e) {Helpers::pre($e->getMessage());
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
            if ($this->service->create($_params)) {
                return redirect(route('admin.redirect.index'));
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
            $data['common'] = Helpers::titleAction([__('admins::layer.redirect.edit.title'), __('admins::layer.redirect.index.title2')]);
            $data['detail'] = $this->service->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            return view('admins::redirectUrls.edit', ['data' => $data]);
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
            $data['detail'] = $this->service->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            $_params = $request->all();
            if ($this->service->update($_params, $id, $data['detail'])) {
                session()->flash('success', __('admins::layer.notify.success'));
                return redirect(route('admin.redirect.index', ['page' => (!empty($_GET['page']) ? $_GET['page'] : 1)]));
            } else {
                $errors = new MessageBag(['error' => __('admins::layer.notify.fail')]);
                return back()->withInput($_params)->withErrors($errors);
            }
        } catch (\Exception $e) {
            return !empty($e->getMessage()) ? abort('500') : abort(404);
        }
    }

    /**
     * Category status
     * @method GET
     */
    public function status($id, $status)
    {
        try {
            if ($this->service->updateStatus($id, $status)) {
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
    public function destroy($id)
    {
        try {
            if ($this->service->destroy($id)) {
                session()->flash('success', __('admins::layer.notify.success'));
            } else {
                session()->flash('error', __('admins::layer.notify.fail'));
            }
            return back();
        } catch (\Exception $e) {
            abort('500');
        }
    }
}
