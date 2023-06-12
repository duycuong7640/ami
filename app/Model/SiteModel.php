<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class SitemapModel extends Model
{
    use HasFactory;
    public static function getuserData(){
        $value=DB::table('posts')->get();
        return $value;
    }
}