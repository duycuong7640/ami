<?php

namespace App\Repository\Admins\Product;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;
use App\Model\Post;
use App\Model\Category;

class ProductRepository implements ProductRepositoryInterface
{
    const TABLE_NAME = 'products';

    public function getList($_data)
    {
        $keyword = !empty($_data['keyword']) ? $_data['keyword'] : '';
        $category_id = !empty($_data['category_id']) ? $_data['category_id'] : [];
        return DB::table(self::TABLE_NAME)
            ->select('products.*', 'categories.title as category_title')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('products.title', 'LIKE', '%' . $keyword . '%');
            })
            ->when($category_id, function ($query, $category_id) {
                return $query->whereIn('products.category_id', $category_id);
            })

            ->orderBy('products.id', 'DESC')

            ->paginate($_data['limit']);
    }

    public function getListVersion($_data)
    {
        return DB::table(self::TABLE_NAME)
            ->select('products.*', 'categories.title as category_title')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
//            ->where("products.play_last_version_updated", ">=", date("Y-m-d"." 22:00:00", strtotime("-1 days")))
//            ->where("products.play_last_version_updated", "<=", date("Y-m-d"." 23:59:59"))
            ->where("products.play_last_version_updated", ">=", date("Y-m-d", strtotime("-1 days")))
            ->where("products.play_last_version_updated", "<=", date("Y-m-d"))
            ->orderBy('products.id', 'DESC')
            ->paginate($_data['limit']);
    }

    public function create($_data)
    {
        try {
            if (DB::table(self::TABLE_NAME)->insert($_data)) {
                Helpers::removeHtml();
                return DB::table(self::TABLE_NAME)->orderByDesc("id")->first();
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update($_data, $_id)
    {
        try {
            if (DB::table(self::TABLE_NAME)->where('id', $_id)->update($_data)) {
                Helpers::removeHtml();
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE_NAME)->where('id', $_id)->first();
    }

    public function updateStatus($_id, $_field, $_status)
    {
        try {
            if (DB::table(self::TABLE_NAME)->where('id', $_id)->update([$_field => $_status])) {
                Helpers::removeHtml();
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function destroyAll($_data)
    {
        try {
            if(empty($_data['check'])) return true;
            if (DB::table(self::TABLE_NAME)->whereIn('id', $_data['check'])->delete()) {
                Helpers::removeHtml();
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function destroy($_id)
    {
        try {
            if (DB::table(self::TABLE_NAME)->where('id', $_id)->delete()) {
                Helpers::removeHtml();
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

}