<?php

namespace Modules\Admins\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\Admins\CommentService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Modules\Admins\Http\Requests\Category\CreateRequest;
use Modules\Admins\Http\Requests\Category\EditRequest;

class CommentController extends Controller
{

    private $commentService;
    private $type;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Category index
     * @method GET
     */
    public function index()
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.comment.index.title'), __('admins::layer.comment.index.title2')]);
            $data['list'] = $this->commentService->getList(['limit' => 20, 'type' => $this->type]);
            return view('admins::comments.index', ['data' => $data]);
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
            $data['common'] = Helpers::titleAction([__('admins::layer.comment.add.title'), __('admins::layer.comment.index.title2')]);
            $data['category'] = $this->commentService->getListMenu(['type' => $this->type]);
            return view('admins::categories.create', ['data' => $data]);
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
            if ($this->commentService->create($_params)) {
                return redirect(route('admin.comment.index'));
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
            $data['common'] = Helpers::titleAction([__('admins::layer.comment.edit.title'), __('admins::layer.comment.index.title2')]);
            $data['detail'] = $this->commentService->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            $data['category'] = $this->commentService->getListMenu(['type' => $this->type, 'parent_id' => [$data['detail']->parent_id]]);
            return view('admins::categories.edit', ['data' => $data]);
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
            $data['detail'] = $this->commentService->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            $_params = $request->all();
            if ($this->commentService->update($_params, $id, $data['detail'])) {
                session()->flash('success', __('admins::layer.notify.success'));
                return redirect(route('admin.comment.index', ['page' => (!empty($_GET['page']) ? $_GET['page'] : 1), 'parent_id' => (request()->has('parent_id') ? request()->get('parent_id') : '')]));
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
            if ($this->commentService->updateStatus($id, $status)) {
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
//            if(in_array($id, [3, 20])){
//                session()->flash('error', __('admins::layer.notify.delete_fail'));
//                return back();
//            }
            if ($this->commentService->destroy($id)) {
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
