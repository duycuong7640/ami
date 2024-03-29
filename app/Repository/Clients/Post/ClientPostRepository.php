<?php

namespace App\Repository\Clients\Post;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;
use App\Model\Post;
use App\Model\Category;

class ClientPostRepository implements ClientPostRepositoryInterface
{
    const TABLE_NAME = 'posts';


    public function findById($_id)
    {
        return DB::table(self::TABLE_NAME)
            ->select('posts.*', 'categories.title as category_title', 'categories.slug as category_slug', 'categories.parent_id as category_parent_id')
            ->leftJoin('categories', 'posts.category_id', 'categories.id')
            ->where('posts.id', $_id)
            ->first();
    }

    public function findBySlug($_slug)
    {
        return DB::table(self::TABLE_NAME)
            ->select('posts.*', 'categories.title as category_title', 'categories.slug as category_slug', 'categories.parent_id as category_parent_id')
            ->leftJoin('categories', 'posts.category_id', 'categories.id')
            ->where('posts.slug', $_slug)
            ->first();
    }

    public function getListByCategory($_data)
    {
        return DB::table(self::TABLE_NAME)
//            ->select('products.*', 'categories.title as category_title')
//            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->whereIn('category_id', $_data['category_id'])
            //->where('choose_1', 1)
            ->where('type', $_data['type'])
            ->orderBy('id', 'DESC')
            ->paginate($_data['limit']);
    }

    public function getListByCate($_data)
    {
        if (!empty($_GET['start']) || !empty($_GET['end'])) {
            return DB::table(self::TABLE_NAME)
                ->whereIn('category_id', $_data['cate_multi'])
                ->where('type', $_data['type'])
                ->whereYear('dienra', '>=', $_GET['start'])
                ->whereYear('dienra', '<=', $_GET['end'])
                ->orderBy('id', 'DESC')
                ->paginate($_data['limit']);
        } else {
            return DB::table(self::TABLE_NAME)
                ->whereIn('category_id', $_data['cate_multi'])
                ->where('type', $_data['type'])
                ->orderBy('id', 'DESC')
                ->paginate($_data['limit']);
        }
    }

    public function getListByCatePage($_data)
    {
        return DB::table(self::TABLE_NAME)
            ->whereIn('category_id', $_data['cate_multi'])
            ->where('type', $_data['type'])
            ->orderBy('id', 'DESC')
//            ->paginate($_data['limit']);
            ->paginate($_data['limit'], ['*'], 'page', $_data['page']);
    }

    public function getListByCateSearch($_data)
    {
        return DB::table(self::TABLE_NAME)
            ->where('title', 'LIKE', '%' . $_data['keyword'] . '%')
            ->where('type', $_data['type'])
            ->orderBy('id', 'DESC')
            ->paginate($_data['limit']);
    }

    public function getListRelated($_data)
    {
        return DB::table(self::TABLE_NAME)
            ->where('category_id', $_data['category_id'])
            ->where('id', '!=', $_data['id'])
            ->where('type', $_data['type'])
            ->orderBy('sort', 'DESC')
            ->paginate($_data['limit']);
    }

    public function getListNew($_data)
    {
        return DB::table(self::TABLE_NAME)
            ->orderBy('id', 'DESC')
            ->limit($_data['limit'])
            ->get();
    }

    public function getListByCategoryNotPaginate($_data)
    {
        if (!empty($_GET['start']) || !empty($_GET['end'])) {
            return DB::table(self::TABLE_NAME)
                ->whereIn('category_id', $_data['cate_multi'])
                ->where('type', $_data['type'])
                ->whereYear('dienra', '>=', $_GET['start'])
                ->whereYear('dienra', '<=', $_GET['end'])
                ->orderBy('id', 'DESC')
                ->limit($_data['limit'])
                ->get();
        } else {
            return DB::table(self::TABLE_NAME)
                ->whereIn('category_id', $_data['cate_multi'])
                ->where('type', $_data['type'])
                ->orderBy('id', 'DESC')
                ->limit($_data['limit'])
                ->get();
        }
    }

}