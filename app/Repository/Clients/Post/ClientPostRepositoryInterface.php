<?php

namespace App\Repository\Clients\Post;

interface ClientPostRepositoryInterface
{
    public function findById($_id);
    public function findBySlug($_slug);
    public function getListByCategory($_data);
    public function getListByCate($_data);
    public function getListByCatePage($_data);
    public function getListByCateSearch($_data);
    public function getListRelated($_data);
    public function getListNew($_data);
    public function getListByCategoryNotPaginate($_data);

}
