<?php

namespace App\Providers;

use App\Helpers\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
//        if (!isset($_SESSION["site"])) {
//            echo "<form method='post'><label>Enter code: 12345 </label><input type='text' name='code' value='' /><input type='submit' value='Submit' ></form>";
//            if (isset($_POST["code"])) if ($_POST["code"] == "12345") {
//                $_SESSION["site"] = "1";
//                header("Refresh:0");
//                exit;
//            }
//            die;
//        }


        //redirect lang
//        if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
//            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
//            if ($lang == "fi") $lang = "ph";
//            if (isset($_SERVER["HTTP_REFERER"])) if (strpos($_SERVER["HTTP_REFERER"], "google")) {
//                if (strpos($_SERVER["HTTP_REFERER"], "google.co.id")) $lang = "id";
//                if (strpos($_SERVER["HTTP_REFERER"], "google.com.ph")) $lang = "ph";
//            }
//            $acceptLang = ['id', 'ph'];
//            $lang_check = in_array($lang, $acceptLang) ? "_" . $lang : '';
//            $lang_search = in_array($lang, $acceptLang) ? $lang : '';
//
//            if (isset($_SERVER["HTTP_REFERER"])) if (strpos($_SERVER["HTTP_REFERER"], "google")) {
//                if (empty($lang_check)) {
//                    if (request()->url() != env("APP_URL")) {
//                        if (strpos(request()->url(), "/id")) {
//                            $ex = explode("/id", request()->url());
//                            if (empty($ex[1])) {
//                                header('Location: ' . env("APP_URL"));
//                                exit;
//                            } elseif (count(explode("/id/", request()->url())) == 2) {
//                                header('Location: ' . str_replace(env("APP_URL") . "/id/", env("APP_URL") . "/", request()->url()));
//                                exit;
//                            }
//                        } elseif (strpos(request()->url(), "/ph")) {
//                            $ex = explode("/ph", request()->url());
//                            if (empty($ex[1])) {
//                                header('Location: ' . env("APP_URL"));
//                                exit;
//                            } elseif (count(explode("/ph/", request()->url())) == 3) {
//                                header('Location: ' . str_replace(env("APP_URL") . "/ph/", env("APP_URL") . "/", request()->url()));
//                                exit;
//                            }
//                        }
//                    }
//                } else {
//                    if ($lang_search == "id") {
//                        $ex = explode("/ph", request()->url());
//                        if (empty($ex[1]) && isset($ex[1])) {
//                            header('Location: ' . str_replace(env("APP_URL") . "/ph", env("APP_URL") . "/id", request()->url()));
//                            exit;
//                        } elseif (count(explode("/ph/", request()->url())) == 2) {
//                            header('Location: ' . str_replace(env("APP_URL") . "/ph/", env("APP_URL") . "/id/", request()->url()));
//                            exit;
//                        } elseif (request()->url() == env("APP_URL")) {
//                            header('Location: ' . str_replace(env("APP_URL"), env("APP_URL") . "/id/", request()->url()));
//                            exit;
//                        } else {
//                            $ex = explode("/id", request()->url());
//                            if (!isset($ex[1])) {
//                                header('Location: ' . str_replace(env("APP_URL"), env("APP_URL") . "/id", request()->url()));
//                                exit;
//                            }
//                        }
//                    } else {
//                        if ($lang_search == "ph") {
//                            $ex = explode("/id", request()->url());
//                            if (empty($ex[1]) && isset($ex[1])) {
//                                header('Location: ' . str_replace(env("APP_URL") . "/id", env("APP_URL") . "/ph", request()->url()));
//                                exit;
//                            } elseif (count(explode("/id/", request()->url())) == 2) {
//                                header('Location: ' . str_replace(env("APP_URL") . "/id/", env("APP_URL") . "/ph/", request()->url()));
//                                exit;
//                            } elseif (request()->url() == env("APP_URL")) {
//                                header('Location: ' . str_replace(env("APP_URL"), env("APP_URL") . "/ph/", request()->url()));
//                                exit;
//                            } else {
//                                $ex = explode("/ph", request()->url());
//                                if (!isset($ex[1])) {
//                                    header('Location: ' . str_replace(env("APP_URL"), env("APP_URL") . "/ph", request()->url()));
//                                    exit;
//                                }
//                            }
//                        }
//                    }
//
//                }
//            }
//        }

//        if (empty($lang_check)) {
//            if (request()->url() != env("APP_URL")) {
//                if(!strpos(request()->url(), "/id")) {
//                    header('Location: ' . env("APP_URL"));
//                    exit;
//                }
//            }
//        } elseif ($lang_check == "_id") {
//            if (request()->url() != env("APP_URL") . "/" . $lang_search) {
//                header('Location: ' . env("APP_URL") . "/" . $lang_search);
//                exit;
//            }
//        }


        //check mobile
        $mbm = 1;
        $strmb = "";
        $user_agent = strtolower(@$_SERVER['HTTP_USER_AGENT']);
        if (preg_match("/phone|iphone|itouch|ipod|ipad|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent)) {
            $mbm = 0;
            $strmb = "_mobile";
        }
        View::share("mobile", $mbm);
        View::share("strmb", $strmb);

        $this->findData();
        try {
            $redirects = Helpers::getJsonRedirect();
            $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $path = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
            if (!strpos($url, "login-admin/")) {
                foreach ($redirects as $row) {
                    if ($row["url"] == $_SERVER["REQUEST_URI"]) {
                        if (!strpos($row["url_to"], "ttps://") && !strpos($row["url_to"], "ttp://")) {
                            header("Location: " . $path . $row["url_to"], true, $row["type"]);
                            exit();
                        } else {
                            header("Location: " . $row["url_to"], true, $row["type"]);
                            exit();
                        }
                    }
                }
            }
        } catch (\Exception $ex) {
            //die($ex->getMessage());
        }


        if(in_array(env('ENVIROMENT'), ['production'])) {
                  \URL::forceScheme('https');
            }
    }

    public function findData()
    {
        try {
            //init
            $file = "find.json";
            if (!Storage::disk("store")->exists($file)) {
                Storage::disk("store")->put($file, "");
            }

            //json get
            $json = Storage::disk("store")->get($file);
            $json = !empty($json) ? @json_decode($json, true) : [];

            //find
            if (isset($_SERVER["HTTP_REFERER"])) if (!strpos($_SERVER["HTTP_REFERER"], "takemod")) {
                $json[md5($_SERVER["HTTP_REFERER"])] = [
                    'url' => $_SERVER["HTTP_REFERER"],
                    "time" => date("Y-m-d H:i:s"),
                    //'json' => $_SERVER
                ];
            }

            Storage::disk("store")->put($file, @json_encode($json));

        } catch (\Exception $ex) {
            //die($ex->getMessage());
        }
    }

}
