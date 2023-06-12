<?php

namespace App\Repository\Admins\Comment;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;

class CommentRepository implements CommentRepositoryInterface
{
    const TABLE_NAME = 'comments';

    public function getList($_data)
    {
        return DB::table(self::TABLE_NAME)
            ->orderBy('id', 'DESC')
            ->paginate($_data['limit']);
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