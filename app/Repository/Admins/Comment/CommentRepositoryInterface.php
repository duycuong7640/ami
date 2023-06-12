<?php

namespace App\Repository\Admins\Comment;

interface CommentRepositoryInterface
{
    public function getList($_data);

    public function findById($_id);

    public function updateStatus($_id, $_field, $_status);

    public function destroy($_id);

}
