<?php

namespace App\Service\Clients;

use App\Helpers\Helpers;
use App\Repository\Clients\Advertisement\AdvertisementRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdvertisementService
{

    private $advRepository;
    const TYPE = ['adv', 'logo', 'slideshow', 'link', 'fixone', 'fixtwo', 'fixthree', 'advone', 'fixfourth'];

    public function __construct(AdvertisementRepositoryInterface $advRepository)
    {
        $this->advRepository = $advRepository;
    }

    public function getListAds()
    {
        return $this->advRepository->getListAds(self::TYPE[0]);
    }

    public function getListAdsLimit($_data)
    {
        return $this->advRepository->getListAdsLimit(array_merge($_data, ['type' => self::TYPE[0]]));
    }

    public function findByLogo()
    {
        return $this->advRepository->findByLogo(self::TYPE[1]);
    }

    public function findFixOne()
    {
        return $this->advRepository->findFirst(self::TYPE[4]);
    }

    public function findFixTwo()
    {
        return $this->advRepository->getListMax(self::TYPE[5], 3);
    }

    public function findFixThree()
    {
        return $this->advRepository->getListMax(self::TYPE[6], 50);
    }

    public function findFourth()
    {
        return $this->advRepository->getListAds(self::TYPE[8]);
    }

    public function findAdv1()
    {
        return $this->advRepository->getListAds(self::TYPE[0]);
    }

    public function findAdv2()
    {
        return $this->advRepository->getListAds(self::TYPE[7]);
    }

    public function getListSlideShow()
    {
        return $this->advRepository->getListSlideShow(self::TYPE[2]);
    }

    public function getListLink()
    {
        return $this->advRepository->getListLink(self::TYPE[3]);
    }
    public function findByFavico()
    {
        return $this->advRepository->findByLogo('favico_web');
    }

}
