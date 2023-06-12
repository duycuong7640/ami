<?php

namespace App\Service\Admins;

use App\Helpers\Helpers;
use App\Repository\Admins\Account\AccountRepositoryInterface;
use App\Repository\Admins\Mailtemplate\MailtemplateRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MailtemplateService
{
    private $mailtemplateRepository;
    const TYPE = ['adv', 'logo', 'slideshow', 'link'];

    public function __construct(MailtemplateRepositoryInterface $mailtemplateRepository)
    {
        $this->mailtemplateRepository = $mailtemplateRepository;
    }

    public function getList($_data = [])
    {
        $_data['keyword'] = request()->has('keyword') ? request()->get('keyword') : '';
        return $this->mailtemplateRepository->getList($_data);
    }

    public function findById($_id)
    {
        return $this->mailtemplateRepository->findById($_id);
    }

    public function updateStatus($_id, $_status)
    {
        return $this->mailtemplateRepository->updateStatus($_id, $_status);
    }

    public function destroy($_id)
    {
        return $this->mailtemplateRepository->destroy($_id);
    }

    public function create($_data)
    {
        if (isset($_data['_token'])) unset($_data['_token']);
        unset($_data['proengsoft_jsvalidation']);
        $db = array_merge($_data, [
            'admin_id' => Auth::guard(Helpers::renderGuard())->user()->id,
            //'type' => $_data['type'],
            'created_at' => date("Y/m/d H:i:s"),
            'updated_at' => date("Y/m/d H:i:s")
        ]);
        return $this->mailtemplateRepository->create($db);
    }

    public function update($_data, $_id)
    {
        if(!isset($_data['send_to_admin'])){
            $_data['send_to_admin'] = 0;
        }
        if(!isset($_data['send_to_user'])){
            $_data['send_to_user'] = 0;
        }
        if (isset($_data['_token'])) unset($_data['_token']);
        if (isset($_data['page'])) unset($_data['page']);
        unset($_data['proengsoft_jsvalidation']);
        $db = array_merge($_data, [
            'updated_at' => date("Y/m/d H:i:s")
        ]);
        return $this->mailtemplateRepository->update($db, $_id);
    }

}
