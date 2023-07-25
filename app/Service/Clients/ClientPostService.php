<?php

namespace App\Service\Clients;

use App\Helpers\Helpers;
use App\Repository\Clients\Post\ClientPostRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClientPostService
{

    private $repository;
    const TYPE = ['new', 'new_about_ami', 'new_location', 'new_event'];

    public function __construct(ClientPostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function findById($_id)
    {
        return $this->repository->findById($_id);
    }

    public function findBySlug($_slug)
    {
        return $this->repository->findBySlug($_slug);
    }

    public function getListByCategory($_data)
    {
        return $this->repository->getListByCategory(array_merge($_data, ['type' => self::TYPE[0], 'limit' => 9]));
    }

    public function getListByCateAmi($_data)
    {
        return $this->repository->getListByCate(array_merge($_data, ['type' => self::TYPE[1]]));
    }

    public function getListByCateLocaltion($_data)
    {
        return $this->repository->getListByCate(array_merge($_data, ['type' => self::TYPE[2]]));
    }

    public function getListByCate($_data)
    {
        return $this->repository->getListByCate(array_merge($_data, ['type' => self::TYPE[0]]));
    }

    public function getListByCateEvent($_data)
    {
        return $this->repository->getListByCate(array_merge($_data, ['type' => self::TYPE[3]]));
    }

    public function getListByCategoryNotPaginate($_data)
    {
        return $this->repository->getListByCategoryNotPaginate(array_merge($_data, ['type' => self::TYPE[0]]));
    }

    public function getListByCategoryNotPaginateEvent($_data)
    {
        return $this->repository->getListByCategoryNotPaginate(array_merge($_data, ['type' => self::TYPE[3]]));
    }

    public function getListByCatePage($_data)
    {
        return $this->repository->getListByCatePage(array_merge($_data, ['type' => self::TYPE[0]]));
    }

    public function getListByCateSearch($_data)
    {
        return $this->repository->getListByCateSearch(array_merge($_data, ['type' => self::TYPE[0]]));
    }

    public function getListRelated($_data)
    {
        return $this->repository->getListRelated(array_merge($_data, ['type' => self::TYPE[0], 'limit' => 5]));
    }

    public function getListRelatedEvent($_data)
    {
        return $this->repository->getListRelated(array_merge($_data, ['type' => self::TYPE[3], 'limit' => 5]));
    }

    public function getListNew()
    {
        return $this->repository->getListNew(['limit' => 5]);
    }

}
