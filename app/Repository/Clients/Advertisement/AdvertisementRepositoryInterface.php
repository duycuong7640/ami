<?php

namespace App\Repository\Clients\Advertisement;

interface AdvertisementRepositoryInterface
{
    public function getListAds($_type);

    public function getListMax($_type, $_limit);

    public function getListAdsLimit($_data);

    public function findByLogo($_type);

    public function findFirst($_type);

    public function getListSlideShow($_type);

    public function getListLink($_type);

}
