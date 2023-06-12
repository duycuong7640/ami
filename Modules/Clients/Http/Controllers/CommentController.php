<?php

namespace Modules\Clients\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('clients::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($id)
    {
        try {
            $data = \request()->only("name", "content");
            $name = !empty($data["name"]) ? $data["name"] : "";
            $content = !empty($data["content"]) ? $data["content"] : "";
            if(empty($id) || empty($name) || empty($content)) abort(404);

            if (DB::table("comments")->insert(["name" => $name, "content" => $content, "post_id" => $id, "created_at" => date("Y/m/d H:i:s"),  "updated_at" => date("Y/m/d H:i:s")])) {
                return back()->withInput();
            } else {
                return back()->withInput();
            }
        } catch (\Exception $e) {
            Helpers::pre($e->getMessage());
            abort('500');
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('clients::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('clients::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
