<?php

namespace App\Repository\Admins\RedirectUrl;

interface RedirectUrlRepositoryInterface
{
    public function getList($_data);

    public function create($_data);

    public function update($_data, $_id);

    public function findById($_id);

    public function updateStatus($_id, $_field, $_status);

    public function destroy($_id);

}
