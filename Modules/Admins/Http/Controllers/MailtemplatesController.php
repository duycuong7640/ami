<?php

namespace Modules\Admins\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\Admins\MailtemplateService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Modules\Admins\Http\Requests\Mailtemplate\CreateRequest;
use Modules\Admins\Http\Requests\Mailtemplate\EditRequest;

class MailtemplatesController extends Controller
{
    private $mailtemplateService;
    private $type;

    public function __construct(MailtemplateService $mailtemplateService)
    {
        $this->mailtemplateService = $mailtemplateService;
        $this->type = $this->mailtemplateService::TYPE[0];
    }

    /**
     * Account index
     * @method GET
     */
    public function index()
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.mailtemplate.index.title'), __('admins::layer.mailtemplate.index.title2')]);
            $data['list'] = $this->mailtemplateService->getList(['limit' => 10, 'type' => $this->type]);
            return view('admins::mailtemplates.index', ['data' => $data]);
        } catch (\Exception $e) {Helpers::pre($e->getMessage());
            abort('500');
        }
    }

    /**
     * Account add
     * @method GET
     */
    public function create()
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.mailtemplate.add.title'), __('admins::layer.mailtemplate.index.title2')]);
            return view('admins::mailtemplates.create', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Account store
     * @method POST
     */
    public function store(CreateRequest $request)
    {
        try {
            $_params = $request->all();
            //$_params['type'] = $this->type;
            if ($this->mailtemplateService->create($_params)) {
                return redirect(route('admin.mailtemplate.index'));
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
     * Account edit
     * @method GET
     */
    public function edit($id)
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.mailtemplate.edit.title'), __('admins::layer.mailtemplate.index.title2')]);
            $data['detail'] = $this->mailtemplateService->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            return view('admins::mailtemplates.edit', ['data' => $data]);
        } catch (\Exception $e) {
            return !empty($e->getMessage()) ? abort('500') : abort(404);
        }
    }

    /**
     * Account update
     * @method POST
     */
    public function update(EditRequest $request, $id)
    {
        try {
            $data['detail'] = $this->mailtemplateService->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            $_params = $request->all();
            if ($this->mailtemplateService->update($_params, $id)) {
                session()->flash('success', __('admins::layer.notify.success'));
                return redirect(route('admin.mailtemplate.index', ['page' => (!empty($_GET['page']) ? $_GET['page'] : 1)]));
            } else {
                $errors = new MessageBag(['error' => __('admins::layer.notify.fail')]);
                return back()->withInput($_params)->withErrors($errors);
            }
        } catch (\Exception $e) {
            return !empty($e->getMessage()) ? abort('500') : abort(404);
        }
    }

    /**
     * Account status
     * @method GET
     */
    public function status($id, $status)
    {
        try {
            if ($this->mailtemplateService->updateStatus($id, $status)) {
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
            if ($this->mailtemplateService->destroy($id)) {
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
