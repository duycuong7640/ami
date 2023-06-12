<?php

namespace App\Repository\Clients\Product;

interface ClientProductRepositoryInterface
{
    public function findById($_id);
    public function findViewed($_ids);
    public function findBySlug($_id);
    public function getListAll($_data);
    public function getListAllJob();
    public function update($_data, $_id);
    public function getListByCate($_data);
    public function getListByCatePage($_data);
    public function getListByCateSearch($_data);
    public function getListHome($_data);
    public function getListRelated($_data);
    public function getListChoose1($_data);
    public function getListChoose3($_data);
    public function getListChoose1All($_data);

}
