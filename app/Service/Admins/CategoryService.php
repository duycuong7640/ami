<?php

namespace App\Service\Admins;

use App\Helpers\Helpers;
use App\Repository\Admins\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryService
{
    private $categoryRepository;
    const TYPE = ['new', 'product', 'new_location', 'new_about_ami', 'new_manager_ami', 'new_distributor', 'link', 'new_event'];
    const TYPE_TEXT = ['new' => 'Tin tức', 'product' => 'Sản phẩm', 'new_location' => 'Trụ sở ami', 'new_about_ami' => 'Về Ami', 'new_manager_ami' => 'Lãnh đạo Ami', 'new_distributor' => 'Nhà phân phối', 'link' => 'Liên kết', 'new_event' => 'Tin tức sự kiện'];

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getList($_data = [])
    {
        if(request()->has('keyword')){
            $_SESSION["keyword_cate"] = request()->get('keyword');
        }
        $_data['keyword'] = isset($_SESSION["keyword_cate"]) ? $_SESSION["keyword_cate"] : '';
//        $_data['keyword'] = request()->has('keyword') ? request()->get('keyword') : '';

        if(request()->has('parent_id')){
            $_SESSION["keyword_parent_id"] = request()->get('parent_id');
        }
        $_data['parent_id'] = isset($_SESSION["keyword_parent_id"]) ? $_SESSION["keyword_parent_id"] : '';
//        $_data['parent_id'] = !empty(request()->get('parent_id')) ? request()->get('parent_id') : 'null';
        return $this->categoryRepository->getList($_data);
    }

    public function getListMenu($_data = [])
    {
        return self::groupListMenu($this->categoryRepository->getListMenu($_data), $_data);
    }

    public function findById($_id)
    {
        return $this->categoryRepository->findById($_id);
    }

    public function findListParentId($_id)
    {
        return $this->categoryRepository->findListParentId($_id);
    }

    public function updateStatus($_id, $_status)
    {
        $detail = self::findById($_id);
        return $this->categoryRepository->updateStatus($_id, $_status, (($detail->$_status) ? 0 : 1));
    }

    public function destroy($_id)
    {
        return $this->categoryRepository->destroy($_id);
    }

    public function checkSlug($_slug, $slug_tmp, $i = 0)
    {
        $row = $this->categoryRepository->checkSlug($slug_tmp);
        if (!empty($row->id)) {
            $i++;
            return self::checkSlug($_slug, $_slug . "-" . $i, $i);
        } else {
            return $slug_tmp;
        }
    }

    public function create($_data)
    {
        if (isset($_data['_token'])) unset($_data['_token']);
        unset($_data['proengsoft_jsvalidation']);
        $db = array_merge($_data, [
            'slug' => !empty($_data['title']) ? Str::slug($_data['title'], '-') : '',
            'admin_id' => Auth::guard(Helpers::renderGuard())->user()->id,
            //'type' => $this::TYPE[0],
            'created_at' => date("Y/m/d H:i:s"),
            'updated_at' => date("Y/m/d H:i:s")
        ]);
        $db["slug"] = self::checkSlug($db["slug"], $db["slug"], 0);

        return $this->categoryRepository->create($db);
    }

    public function update($_data, $_id, $_detail)
    {
        if (isset($_data['_token'])) unset($_data['_token']);
        if (isset($_data['page'])) unset($_data['page']);
        unset($_data['proengsoft_jsvalidation']);
        $db = array_merge($_data, [
            'updated_at' => date("Y/m/d H:i:s")
        ]);

        if ($_detail->title == $_data["title"]) {
            $db["slug"] = $_detail->slug;
        } else {
            $db["slug"] = self::checkSlug(Str::slug($_data["title"], "-"), Str::slug($_data["title"], "-"), 0);
        }

        return $this->categoryRepository->update($db, $_id);
    }

    public function groupListMenu($_data, $_params = [])
    {
        $arr = [];
        foreach ($_data as $row) {
            if (empty($row->parent_id)) {
                $arr['parent'][$row->id] = (array)$row;
            } else {
                $arr['list'][$row->parent_id][] = (array)$row;
            }
            $arr['ids'][$row->id] = $row->title;
        }

        if(isset($_params['multi'])){
            return [
                'select' => !empty($arr) ? self::mergeListMenu($arr, $_params) : '<option value="">' . (__('admins::layer.search.form.category')) . '</option>',
                'list' => !empty($arr) ? self::mergeListMenuArray($arr, $_params) : [],
                'ids' => !empty($arr) ? $arr['ids'] : []
            ];
        }else {
            return !empty($arr) ? self::mergeListMenu($arr, $_params) : '<option value="">' . (__('admins::layer.search.form.category')) . '</option>';
        }
    }

    public function mergeListMenu($_data, $_params, $parent_id = null, $trees = null, $i = 0, $str = '')
    {
        //params
        $active_id = !empty($_params['parent_id']) ? $_params['parent_id'] : [];

        //parent
        if (!empty($_data['parent'])) {
            $trees .= '<option value="">' . (__('admins::layer.search.form.category')) . '</option>';
            foreach ($_data['parent'] as $row) {
                $trees .= '<option value="' . $row['id'] . '" ' . (in_array($row['id'], $active_id) ? 'selected' : '') . '>' . $row['title'] . '</option>';
                if (!empty($_data['list'][$row['id']])) $trees = self::mergeListMenu($_data['list'], $_params, $row['id'], $trees, 1, '--');
            }
        } else {
            $tmp = '';
            for ($j = 0; $j < $i; $j++) $tmp .= $str;
            foreach ($_data[$parent_id] as $row) {
                $trees .= '<option value="' . $row['id'] . '" ' . (in_array($row['id'], $active_id) ? 'selected' : '') . '>' . $tmp . ' ' . $row['title'] . '</option>';
                if (!empty($_data[$row['id']])) $trees = self::mergeListMenu($_data, $_params, $row['id'], $trees, $i + 1, '--');
            }
        }
        return $trees;

    }

    public function mergeListMenuArray($_data, $_params, $parent_id = null, $trees = null, $i = 0, $str = '')
    {
        //parent
        if (!empty($_data['parent'])) {
            foreach ($_data['parent'] as $row) {
                $trees[$row['id']] = $row['title'];
                if (!empty($_data['list'][$row['id']])) $trees = self::mergeListMenuArray($_data['list'], $_params, $row['id'], $trees, 1, '--');
            }
        } else {
            $tmp = '';
            for ($j = 0; $j < $i; $j++) $tmp .= $str;
            foreach ($_data[$parent_id] as $row) {
                $trees[$row['id']] = $tmp . ' ' . $row['title'];
                if (!empty($_data[$row['id']])) $trees = self::mergeListMenuArray($_data, $_params, $row['id'], $trees, $i + 1, '--');
            }
        }
        return $trees;

    }

    public function multiCate($_parentid = null, $_trees = NULL)
    {
        $parmenu = self::findListParentId($_parentid);
        $_trees[$_parentid] = $_parentid;
        if (count($parmenu) > 0) {
            foreach ($parmenu as $field) {
                $_trees[$field->id] = $field->id;
                $_trees = $this->multiCate($field->id, $_trees);
            }
        }
        return $_trees;
    }

}
