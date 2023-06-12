<?php

namespace App\Repository\Clients\Product;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;
use App\Model\Post;
use App\Model\Category;
use Illuminate\Support\Str;

class ClientProductRepository implements ClientProductRepositoryInterface
{
    const TABLE_NAME = 'products';

    public function findById($_id)
    {
        return DB::table(self::TABLE_NAME)
            ->select('products.*', 'categories.title as category_title', 'categories.title_es as category_title_es', 'categories.title_pt as category_title_pt', 'categories.title_id as category_title_id', 'categories.title_ph as category_title_ph', 'categories.slug as category_slug', 'categories.parent_id as category_parent_id')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.id', $_id)
            ->first();
    }

    public function findViewed($_ids)
    {
        return DB::table(self::TABLE_NAME)
            ->whereIn('products.id', $_ids)
            ->get();
    }

    public function findBySlug($_id)
    {
        return DB::table(self::TABLE_NAME)
            ->select('products.*', "admins.name as admin_name", 'categories.title as category_title', 'categories.title_en as category_title_en', 'categories.slug as category_slug', 'categories.parent_id as category_parent_id')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->leftJoin('admins', 'products.admin_id', 'admins.id')
            ->where('products.slug', $_id)
            ->first();
    }

    public function getListAll($_data)
    {
        $lang = isset($_SESSION["lang"]) ? $_SESSION["lang"] : "en";

        return DB::table(self::TABLE_NAME)
            ->where('type', $_data['type'])
            ->when($lang, function ($query, $lang) {
                if ($lang == "en") return $query->whereNotNull('content');
                if ($lang == "_es") return $query->whereNotNull('content_es');
                if ($lang == "_pt") return $query->whereNotNull('content_pt');
                if ($lang == "_id") return $query->whereNotNull('content_id');
            })
            ->orderBy('id', 'DESC')
            ->paginate($_data['limit']);
    }

    public function getListAllJob()
    {
        return DB::table(self::TABLE_NAME)
            ->where('choose_5', 1)
            ->select("id", "code", "play_last_version")
            ->get();
    }

    public function update($_data, $_id)
    {
        try {
            if (DB::table(self::TABLE_NAME)->where('id', $_id)->update($_data)) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getListChoose1All($_data)
    {
        $lang = isset($_SESSION["lang"]) ? $_SESSION["lang"] : "en";
        return DB::table(self::TABLE_NAME)
            ->where('choose_1', 1)
            ->when($lang, function ($query, $lang) {
                if ($lang == "en") return $query->whereNotNull('content');
                if ($lang == "_es") return $query->whereNotNull('content_es');
                if ($lang == "_pt") return $query->whereNotNull('content_pt');
                if ($lang == "_id") return $query->whereNotNull('content_id');
            })
            ->orderBy('id', 'DESC')
            ->paginate($_data['limit']);
    }

    public function getListByCate($_data)
    {
        $lang = isset($_SESSION["lang"]) ? $_SESSION["lang"] : "en";
        $querry = DB::table(self::TABLE_NAME);
        if (!isset($_GET["author"])) $querry = $querry->whereIn('category_id', $_data['cate_multi']);
        $querry = $querry->when($lang, function ($query, $lang) {
            if ($lang == "en") return $query->whereNotNull('content');
            if ($lang == "_es") return $query->whereNotNull('content_es');
            if ($lang == "_pt") return $query->whereNotNull('content_pt');
            if ($lang == "_id") return $query->whereNotNull('content_id');
        });
        $querry = $querry->where('type', $_data['type']);

        if (!empty($_data['filter'])) {
            if ($_data['filter'] == 'pb') $querry = $querry->where('choose_1', 1);
            if ($_data['filter'] == 'bc') $querry = $querry->where('choose_2', 1);
        }

        if (!empty($_data['filter']) && in_array($_data['filter'], ['pasc', 'pdesc'])) {
            if ($_data['filter'] == 'pasc') $querry = $querry->orderBy('price', 'ASC');
            if ($_data['filter'] == 'pdesc') $querry = $querry->orderBy('price', 'DESC');
        } else {
            $querry = $querry->orderBy('id', 'DESC');
        }

        return $querry->paginate($_data['limit']);
    }

    public function getListByCatePage($_data)
    {
        $lang = isset($_SESSION["lang"]) ? $_SESSION["lang"] : "en";
        $querry = DB::table(self::TABLE_NAME);
        if (!isset($_GET["author"])) $querry = $querry->whereIn('category_id', $_data['cate_multi']);
        $querry = $querry->when($lang, function ($query, $lang) {
            if ($lang == "en") return $query->whereNotNull('content');
            if ($lang == "_es") return $query->whereNotNull('content_es');
            if ($lang == "_pt") return $query->whereNotNull('content_pt');
            if ($lang == "_id") return $query->whereNotNull('content_id');
        });
        $querry = $querry->where('type', $_data['type']);

        if (isset($_GET["author"])) {
            $querry = $querry->where('play_dev', $_GET["author"]);
        }

        if (isset($_GET["type"])) {
            $querry = $querry->orderBy('play_last_version_updated', 'DESC');
        } else {
            $querry = $querry->orderBy('id', 'DESC');
        }

        return $querry->paginate($_data['limit'], ['*'], 'page', $_data['page']);
    }

    public function getListByCateSearch($_data)
    {
        $lang = isset($_SESSION["lang"]) ? $_SESSION["lang"] : "en";
        $ex_keyword = explode(" ", $_data['keyword']);
        $arr = [];
//        foreach ($ex_keyword as $row) {
//            $slug = Str::slug($row);
//            $search = DB::table(self::TABLE_NAME)
//                ->where('slug', 'LIKE', '%' . $slug . '%')
//                ->orderBy('id', 'DESC')
//                ->pluck("id", "id")->toArray();
//            $arr = array_merge($arr, $search);
//        }

        $arr2 = [];
        for ($i = 0; $i <= ceil(count($ex_keyword) / 2); $i++) {
            $j = 0;
            $tmp = [];
            foreach ($ex_keyword as $key => $row) {
                unset($ex_keyword[$key]);
                $tmp[] = Str::slug($row);
                $j++;
                if ($j == 3) break;
            }
            $arr2[] = implode("-", $tmp);
        }

        foreach ($arr2 as $row) {
            $search = DB::table(self::TABLE_NAME)
                ->where('slug', 'LIKE', '%' . $row . '%')
                ->when($lang, function ($query, $lang) {
                    if ($lang == "en") return $query->whereNotNull('content');
                    if ($lang == "_es") return $query->whereNotNull('content_es');
                    if ($lang == "_pt") return $query->whereNotNull('content_pt');
                    if ($lang == "_id") return $query->whereNotNull('content_id');
                })
                ->orderBy('id', 'DESC')
                ->pluck("id", "id")->toArray();
            $arr = array_merge($arr, $search);
        }

        $arr_id = [];
        foreach ($arr as $row) {
            $arr_id[$row] = $row;
        }
        if (empty($arr_id)) return [];

        return DB::table(self::TABLE_NAME)
            //->where('title', 'LIKE', '%' . $_data['keyword'] . '%')
            //->where('type', $_data['type'])
            ->whereIn('id', $arr_id)
            ->when($lang, function ($query, $lang) {
                if ($lang == "en") return $query->whereNotNull('content');
                if ($lang == "_es") return $query->whereNotNull('content_es');
                if ($lang == "_pt") return $query->whereNotNull('content_pt');
                if ($lang == "_id") return $query->whereNotNull('content_id');
            })
            ->orderBy('id', 'DESC')
            ->paginate($_data['limit']);
    }

    public function getListHome($_data)
    {
        $lang = isset($_SESSION["lang"]) ? $_SESSION["lang"] : "en";
        return DB::table(self::TABLE_NAME)
            ->select('products.*', 'categories.title as category_title')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.type', $_data['type'])
            ->when($lang, function ($query, $lang) {
                if ($lang == "en") return $query->whereNotNull('products.content');
                if ($lang == "_es") return $query->whereNotNull('products.content_es');
                if ($lang == "_pt") return $query->whereNotNull('products.content_pt');
                if ($lang == "_id") return $query->whereNotNull('products.content_id');
            })
            ->orderBy('products.id', 'DESC')
            ->paginate($_data['limit']);
    }

    public function getListRelated($_data)
    {
        $lang = isset($_SESSION["lang"]) ? $_SESSION["lang"] : "en";
        return DB::table(self::TABLE_NAME)
            ->where('category_id', $_data['category_id'])
//            ->when($lang, function ($query, $lang) {
//                if ($lang == "en") return $query->whereNotNull('content');
//                if ($lang == "_es") return $query->whereNotNull('content_es');
//                if ($lang == "_pt") return $query->whereNotNull('content_pt');
//                if ($lang == "_id") return $query->whereNotNull('content_id');
//            })
            ->where('type', $_data['type'])
            ->orderBy('sort', 'DESC')
            ->paginate($_data['limit']);
    }

    public function getListChoose1($_data)
    {
        $lang = isset($_SESSION["lang"]) ? $_SESSION["lang"] : "en";
        return DB::table(self::TABLE_NAME)
            ->where('choose_1', 1)
            ->when($lang, function ($query, $lang) {
                if ($lang == "en") return $query->whereNotNull('content');
                if ($lang == "_es") return $query->whereNotNull('content_es');
                if ($lang == "_pt") return $query->whereNotNull('content_pt');
                if ($lang == "_id") return $query->whereNotNull('content_id');
            })
            ->orderBy('sort', 'DESC')
            ->limit($_data['limit'])->get();
    }

    public function getListChoose3($_data)
    {
        $lang = isset($_SESSION["lang"]) ? $_SESSION["lang"] : "en";
        return DB::table(self::TABLE_NAME)
            ->where('choose_3', 1)
            ->when($lang, function ($query, $lang) {
                if ($lang == "en") return $query->whereNotNull('content');
                if ($lang == "_es") return $query->whereNotNull('content_es');
                if ($lang == "_pt") return $query->whereNotNull('content_pt');
                if ($lang == "_id") return $query->whereNotNull('content_id');
            })
            ->orderBy('sort', 'DESC')
            ->limit($_data['limit'])->get();
    }

}