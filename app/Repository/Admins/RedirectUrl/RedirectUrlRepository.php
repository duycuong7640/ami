<?php

namespace App\Repository\Admins\RedirectUrl;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;

class RedirectUrlRepository implements RedirectUrlRepositoryInterface
{
    const TABLE_NAME = 'redirect_urls';

    public function getList($_data)
    {
        $keyword = !empty($_data['keyword']) ? $_data['keyword'] : '';
        $type = !empty($_data['type']) ? $_data['type'] : '';
        return DB::table(self::TABLE_NAME)->select('redirect_urls.*', 'admins.name as admin_name')
            ->leftJoin('admins', 'redirect_urls.admin_id', 'admins.id')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('redirect_urls.url', 'LIKE', '%' . $keyword . '%');
            })
            ->when($keyword, function ($query, $keyword) {
                return $query->orWhere('redirect_urls.url_to', 'LIKE', '%' . $keyword . '%');
            })
            ->when($type, function ($query, $type) {
                return $query->where('redirect_urls.type', $type);
            })
            ->orderBy('redirect_urls.id', 'DESC')
            ->paginate($_data['limit']);
    }

    public function create($_data)
    {
        try {
            if (DB::table(self::TABLE_NAME)->insert($_data)) {
                return true;
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
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {Helpers::pre($e->getMessage());
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
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

}