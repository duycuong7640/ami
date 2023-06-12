<?php

namespace App\Service\Clients;

use App\Helpers\Helpers;
use App\Repository\Clients\Advertisement\AdvertisementRepositoryInterface;
use App\Repository\Clients\Product\ClientProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClientProductService
{

    private $repository;
    const TYPE = ['product'];

    public function __construct(ClientProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function findById($_id)
    {
        return $this->repository->findById($_id);
    }

    public function findViewed($_ids)
    {
        return $this->repository->findViewed($_ids);
    }

    public function findBySlug($_id)
    {
        return $this->repository->findBySlug($_id);
    }

    public function getListAll($_data)
    {
        return $this->repository->getListAll(array_merge($_data, ['type' => self::TYPE[0]]));
    }

    public function getListAllJob()
    {
        return $this->repository->getListAllJob();
    }

    public function update($_data, $_id)
    {
        return $this->repository->update($_data, $_id);
    }

    public function getListByCate($_data)
    {
        return $this->repository->getListByCate(array_merge($_data, ['type' => self::TYPE[0]]));
    }

    public function getListByCatePage($_data)
    {
        return $this->repository->getListByCatePage(array_merge($_data, ['type' => self::TYPE[0]]));
    }

    public function getListByCateSearch($_data)
    {
        return $this->repository->getListByCateSearch(array_merge($_data, ['type' => self::TYPE[0]]));
    }

    public function getListHome($_data)
    {
        return $this->repository->getListHome(array_merge($_data, ['type' => self::TYPE[0]]));
    }

    public function getListRelated($_data)
    {
        return $this->repository->getListRelated(array_merge($_data, ['type' => self::TYPE[0], 'limit' => 5]));
    }

    public function getListChoose1($_data)
    {
        return $this->repository->getListChoose1($_data);
    }

    public function getListChoose3($_data)
    {
        return $this->repository->getListChoose3($_data);
    }

    public function getListChoose1All($_data)
    {
        return $this->repository->getListChoose1All($_data);
    }

}
