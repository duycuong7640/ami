<?php

namespace App\Service\Admins;

use App\Helpers\Helpers;
use App\Repository\Admins\Comment\CommentRepositoryInterface;

class CommentService
{
    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getList($_data = [])
    {
        $_data['keyword'] = request()->has('keyword') ? request()->get('keyword') : '';
        $_data['parent_id'] = !empty(request()->get('parent_id')) ? request()->get('parent_id') : 'null';
        return $this->commentRepository->getList($_data);
    }

    public function findById($_id)
    {
        return $this->commentRepository->findById($_id);
    }

    public function updateStatus($_id, $_status)
    {
        $detail = self::findById($_id);
        return $this->commentRepository->updateStatus($_id, $_status, (($detail->$_status) ? 0 : 1));
    }

    public function destroy($_id)
    {
        return $this->commentRepository->destroy($_id);
    }

}
