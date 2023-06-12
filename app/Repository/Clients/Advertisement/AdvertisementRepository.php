<?php

namespace App\Repository\Clients\Advertisement;

use Illuminate\Support\Facades\DB;

class AdvertisementRepository implements AdvertisementRepositoryInterface
{
    const TABLE_NAME = 'advertisements';

    public function getListAds($_type)
    {
        return DB::table(self::TABLE_NAME)->where('type', $_type)->where('status', 1)->get();
    }

    public function getListMax($_type, $_limit)
    {
        return DB::table(self::TABLE_NAME)->where('type', $_type)->where('status', 1)->limit($_limit)->get();
    }

    public function getListAdsLimit($_data)
    {
        return DB::table(self::TABLE_NAME)->select('id', 'title', 'thumbnail', 'thumbnail2', 'url', 'type')->where('type', $_data['type'])->where('status', 1)->limit($_data['limit'])->get();
    }

    public function findByLogo($_type)
    {
        return DB::table(self::TABLE_NAME)->select('id', 'title', 'thumbnail', 'thumbnail2', 'url', 'type')->where('type', $_type)->where('status', 1)->first();
    }

    public function getListSlideShow($_type)
    {
        return DB::table(self::TABLE_NAME)->select('id', 'title', 'thumbnail', 'thumbnail2', 'url', 'type')->where('type', $_type)->where('status', 1)->get();
    }

    public function getListLink($_type)
    {
        return DB::table(self::TABLE_NAME)->select('id', 'title', 'thumbnail', 'thumbnail2', 'description', 'url', 'url_title', 'type')->where('type', $_type)->where('status', 1)->get();
    }

    public function findFirst($_type)
    {
        return DB::table(self::TABLE_NAME)->where('type', $_type)->where('status', 1)->first();
    }

}