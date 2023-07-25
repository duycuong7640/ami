<?php
/**
 * Created by cuongnd
 */

namespace App\Helpers;

use App\Model\RedirectUrl;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Model\Category;
use App\Model\Post;
use App\Model\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Clients\Http\Controllers\HomeController;

class Helpers
{
    public static function pre($data = array())
    {
        echo '<pre>';
        print_r($data);
        die;
    }

    public static function lang($row, $field = "")
    {
        $field .= $_SESSION["lang"];
        return !empty($row->$field) ? $row->$field : "";
    }

    public static function langArr($row, $field = "")
    {
        $field .= $_SESSION["lang"];
        return !empty($row[$field]) ? $row[$field] : "";
    }

    public static function langDefine($text = "")
    {
        $es = "_en";

        $arr = [
            md5("Xem thêm") => [
                "" => "Xem thêm",
                $es => "View more",
            ],
            md5("SẢN PHẨM HÀNG ĐẦU") => [
                "" => "SẢN PHẨM HÀNG ĐẦU",
                $es => "TOP PRODUCTS",
            ],
            md5("sptopt") => [
                "" => "Sản phẩm đến từ các chuyên gia, các nền y học phát triển nhất trên thế giới. Đã chứng minh hiệu quả ở nhiều quốc gia",
                $es => "Products come from experts, the most developed medical background in the world. Proven effective in many countries",
            ],
            md5("SẢN PHẨM CHÍNH NGẠCH") => [
                "" => "SẢN PHẨM CHÍNH NGẠCH",
                $es => "MAIN PRODUCTS ONLY",
            ],
            md5("spcn") => [
                "" => "Sản phẩm sở hữu độc quyền bởi Ami. Sản phẩm đạt tiêu chuẩn quốc tế, có đầy đủ giấy tờ pháp lý để kinh doanh tại thị trường Việt Nam",
                $es => "Products owned exclusively by Ami. Products meet international standards, have full legal documents to do business in Vietnam market",
            ],
            md5("TIÊU DÙNG LÕI XANH") => [
                "" => "TIÊU DÙNG LÕI XANH",
                $es => "CONSUMPTION OF GREEN PROFIT",
            ],
            md5("tdlx") => [
                "" => "Hướng đến lối tiêu dùng xanh, an toàn bản thân, an toàn cho môi trường, tạo các giá trị bền vững",
                $es => "Towards a green consumption style, safe for yourself, safe for the environment, creating sustainable values",
            ],
            md5("ĐA ĐIỂM CHẠM") => [
                "" => "ĐA ĐIỂM CHẠM",
                $es => "MULTIPLE TOUCHING",
            ],
            md5("ddc") => [
                "" => "Người tiêu dùng dễ dàng tiếp cận sản phẩm, tiếp cận đội ngũ hỗ trợ và các chuyên gia sức khoẻ để tăng hiệu quả khi sử dụng sản phẩm",
                $es => "Consumers easily access the product, access the support team and health professionals to increase efficiency when using the product",
            ],
            md5("CỘNG ĐỒNG TIÊU DÙNG PHỦ KHẮP") => [
                "" => "CỘNG ĐỒNG TIÊU DÙNG PHỦ KHẮP",
                $es => "COMPANY CONSUMER COMMUNITY",
            ],
            md5("cdtdpk") => [
                "" => "Cộng đồng tiêu dùng sản phẩm rộng khắp, dễ dàng trong việc tìm kiếm người đồng hành, cùng chia sẻ kiến thức trong quá trình sử dụng",
                $es => "Wide product community, easy to find companions, to share knowledge during use",
            ],
            md5("KẾT NỐI") => [
                "" => "KẾT NỐI",
                $es => "CONNECT",
            ],
            md5("b_1") => [
                "" => "Kết nối các điểm chạm cùng mục tiêu, chung cách hành xử",
                $es => "Connecting touch points with the same goal, the same behavior",
            ],
            md5("KIẾN TẠO") => [
                "" => "KIẾN TẠO",
                $es => "ASSIST",
            ],
            md5("b_2") => [
                "" => "Kiến tạo một cồng đồng Ami thành đạt toàn diện",
                $es => "Building a successful Ami community",
            ],
            md5("LAN TỎA") => [
                "" => "LAN TỎA",
                $es => "SPREAD",
            ],
            md5("b_3") => [
                "" => "Lan toả công thức thành công, văn hoá 3G4T đến cộng đồng lớn",
                $es => "Spread the success formula, 3G4T culture to the large community",
            ],
            md5("TỪNG BƯỚC BIẾN GIẤC MƠ THÀNH SỰ THẬT") => [
                "" => "TỪNG BƯỚC BIẾN GIẤC MƠ THÀNH SỰ THẬT",
                $es => "STEPS TO TURN A DREAM INTO TRUTH",
            ],
            md5("LĨNH VỰC HOẠT ĐỘNG") => [
                "" => "LĨNH VỰC HOẠT ĐỘNG",
                $es => "FIELD OF ACTIVITIES",
            ],
            md5("NHỮNG CON SỐ ẤN TƯỢNG") => [
                "" => "NHỮNG CON SỐ ẤN TƯỢNG",
                $es => "IMPRESSIVE NUMBERS",
            ],
            md5("TỶ USD") => [
                "" => "TỶ USD",
                $es => "BILLION USD",
            ],
            md5("GIÁ TRỊ THƯƠNG HIỆU") => [
                "" => "GIÁ TRỊ THƯƠNG HIỆU",
                $es => "BRAND VALUE",
            ],
            md5("TRUNG TÂM HOẠT ĐÔNG") => [
                "" => "TRUNG TÂM HOẠT ĐÔNG",
                $es => "HUB",
            ],
            md5("SINH HOẠT CỘNG ĐỒNG") => [
                "" => "SINH HOẠT CỘNG ĐỒNG",
                $es => "COMMUNITY ACTIVITIES",
            ],
            md5("THÀNH VIÊN MỚI") => [
                "" => "THÀNH VIÊN MỚI",
                $es => "NEW MEMBER",
            ],
            md5("TRONG NĂM 2022") => [
                "" => "TRONG NĂM 2022",
                $es => "IN 2022",
            ],
            md5("NHÀ PHÂN PHỐI DẪN ĐẦU") => [
                "" => "NHÀ PHÂN PHỐI DẪN ĐẦU",
                $es => "LEADING DISTRIBUTOR",
            ],
            md5("BAN LÃNH ĐẠO") => [
                "" => "BAN LÃNH ĐẠO",
                $es => "LEADERSHIP",
            ],
            md5("CỐ VẤN CHIẾN LƯỢC") => [
                "" => "CỐ VẤN CHIẾN LƯỢC",
                $es => "STRATEGIC ADVICE",
            ],
            md5("TIN TỨC CẬP NHẬT") => [
                "" => "TIN TỨC CẬP NHẬT",
                $es => "NEWS UPDATE",
            ],
            md5("Tin mới nhất") => [
                "" => "Tin mới nhất",
                $es => "Latest news",
            ],
            md5("Related news") => [
                "" => "Tin liên quan",
                $es => "Related news",
            ],
            md5("SẢN PHẨM") => [
                "" => "SẢN PHẨM",
                $es => "PRODUCT",
            ],
            md5("TẤT CẢ SẢN PHẨM") => [
                "" => "TẤT CẢ SẢN PHẨM",
                $es => "ALL PRODUCTS",
            ],
            md5("SẢN PHẨM ĐÃ XEM") => [
                "" => "SẢN PHẨM ĐÃ XEM",
                $es => "VIEWED PRODUCTS",
            ],
            md5("SẢN PHẨM LIÊN QUAN") => [
                "" => "SẢN PHẨM LIÊN QUAN",
                $es => "RELATED PRODUCTS",
            ],
            md5("Mô tả sản phẩm") => [
                "" => "Mô tả sản phẩm",
                $es => "Product Description",
            ],
            md5("Kinh doanh cùng ami") => [
                "" => "Kinh doanh cùng ami",
                $es => "Doing business with ami",
            ],
            md5("Thời gian từ") => [
                "" => "Thời gian từ",
                $es => "Time from",
            ],
            md5("Đến") => [
                "" => "Đến",
                $es => "To",
            ],
            md5("Sunday") => [
                "" => "Chủ nhật",
                $es => "Sunday",
            ],
            md5("Monday") => [
                "" => "Thứ hai",
                $es => "Monday",
            ],
            md5("Tuesday") => [
                "" => "Thứ ba",
                $es => "Tuesday",
            ],
            md5("Wednesday") => [
                "" => "Thứ tư",
                $es => "Wednesday",
            ],
            md5("Thursday") => [
                "" => "Thứ năm",
                $es => "Thursday",
            ],
            md5("Friday") => [
                "" => "Thứ sáu",
                $es => "Friday",
            ],
            md5("Saturday") => [
                "" => "Thứ bẩy",
                $es => "Saturday",
            ],
            md5("Diễn ra lúc") => [
                "" => "Diễn ra lúc",
                $es => "Time start",
            ],
            md5("Tại") => [
                "" => "Tại",
                $es => "Location",
            ],
            md5("NHÀ PHÂN PHỐI") => [
                "" => "NHÀ PHÂN PHỐI",
                $es => "DISTRIBUTOR",
            ],
            md5("TRONG NĂM 2023") => [
                "" => "TRONG NĂM 2023",
                $es => "IN 2023",
            ],
            md5("KHÁCH HÀNG TIÊU DÙNG") => [
                "" => "KHÁCH HÀNG TIÊU DÙNG",
                $es => "CONSUMER CUSTOMERS",
            ],
            md5("ĐỐI TÁC") => [
                "" => "ĐỐI TÁC",
                $es => "PARTNER",
            ],
            md5("TOÀN CẦU") => [
                "" => "TOÀN CẦU",
                $es => "GLOBAL",
            ],
            md5("Tháng") => [
                "" => "Tháng",
                $es => "Month",
            ],
            md5("Lan tỏa trên Facebook") => [
                "" => "Lan tỏa trên Facebook",
                $es => "Spread on Facebook",
            ],
            md5("Gửi trực tiếp cho bạn bè") => [
                "" => "Gửi trực tiếp cho bạn bè",
                $es => "Send it directly to your friends",
            ],
            md5("SỰ KIỆN CẬP NHẬT") => [
                "" => "SỰ KIỆN CẬP NHẬT",
                $es => "EVENT UPDATE",
            ],
            md5("Tiêu chuẩn quốc tế") => [
                "" => "Tiêu chuẩn quốc tế",
                $es => "International Standard",
            ],
            md5("a_1") => [
                "" => "Sản phẩm đến từ các nền y học phát triển nhất thế giới. Đã chứng minh hiệu quả ở nhiều quốc gia.",
                $es => "Products come from the most developed medical background in the world. Proven effective in many countries.",
            ],
            md5("Phân phối độc quyền") => [
                "" => "Phân phối độc quyền",
                $es => "Exclusive distribution",
            ],
            md5("a_2") => [
                "" => "Sản phẩm chính ngạch, hoàn thiện pháp lý để kinh doanh tại Việt Nam.",
                $es => "Official products, legal completion for business in Vietnam.",
            ],
            md5("Tiện ích 4.0") => [
                "" => "Tiện ích 4.0",
                $es => "Utility 4.0",
            ],
            md5("a_4") => [
                "" => "Người tiêu dùng, nhà phân phối dễ dàng tiếp cận sản phẩm, cơ hội kinh doanh qua ứng dụng điện thoại.",
                $es => "Consumers and distributors can easily access products and business opportunities through mobile applications.",
            ],
            md5("Cộng đồng tiêu dùng Ami") => [
                "" => "Cộng đồng tiêu dùng Ami",
                $es => "Ami . Consumer Community",
            ],
            md5("a_5") => [
                "" => "Tham gia cộng đồng Ami để học tập, phát triển bản thân, tìm kiếm cộng sự, cơ hội kinh doanh.",
                $es => "Join Ami community to learn, develop yourself, find partners, business opportunities.",
            ],
            md5("") => [
                "" => "",
                $es => "",
            ],
        ];

        return !empty($arr[md5($text)][$_SESSION["lang"]]) ? $arr[md5($text)][$_SESSION["lang"]] : "";
    }

    public static function renderHtmlDescription($content = "")
    {
        $pattern_span = <<<'regex'
/<\/span>/
regex;
        $str = preg_replace($pattern_span, "", $content);
        $pattern_span = <<<'regex'
/<span.*?>/
regex;
        $str = preg_replace($pattern_span, "", $str);
        $pattern_span = <<<'regex'
/<\/div>/
regex;
        $str = preg_replace($pattern_span, "", $str);
        $pattern_span = <<<'regex'
/<div.*?>/
regex;
        $str = preg_replace($pattern_span, "", $str);
//        $pattern_span = <<<'regex'
//
        /*/<p.*?>/*/
//regex;
//        $str = preg_replace($pattern_span, "<p>", $str);

        //tag heading
        $pattern_span = <<<'regex'

/<h1.*?>/
regex;
        $str = preg_replace($pattern_span, "<h1>", $str);
        $pattern_span = <<<'regex'

/<h2.*?>/
regex;
        $str = preg_replace($pattern_span, "<h2>", $str);
        $pattern_span = <<<'regex'

/<h3.*?>/
regex;
        $str = preg_replace($pattern_span, "<h3>", $str);
        $pattern_span = <<<'regex'

/<h4.*?>/
regex;
        $str = preg_replace($pattern_span, "<h4>", $str);

        preg_match_all('/<h2(.*?)>(.+?)<\/h2>|<h3(.*?)>(.*?)<\/h3>|<h4(.*?)>(.*?)<\/h4>|<h5(.*?)>(.*?)<\/h5>|<h6(.*?)>(.*?)<\/h6>/is', $str, $tach_h);
        $matches = $tach_h[0];
        if (count($matches) > 0) {
            $i = 0;
            foreach ($matches as $key => $match) {
                $id_tab = 'id="position_' . $i . '"';
                if (strpos("--" . $match, "<h1")) {
                    $pattern = '/<h1.*?>/i';
                    $s = preg_replace($pattern, "<h1 " . $id_tab . ">", $match);
                    $str = str_replace($match, $s, $str);
                }
                if (strpos("--" . $match, "<h2")) {
                    $pattern = '/<h2.*?>/i';
                    $s = preg_replace($pattern, "<h2 " . $id_tab . ">", $match);
                    $str = str_replace($match, $s, $str);
                }
                if (strpos("--" . $match, "<h3")) {
                    $pattern = '/<h3.*?>/i';
                    $s = preg_replace($pattern, "<h3 " . $id_tab . ">", $match);
                    $str = str_replace($match, $s, $str);
                }
                if (strpos("--" . $match, "<h4")) {
                    $pattern = '/<h4.*?>/i';
                    $s = preg_replace($pattern, "<h4 " . $id_tab . ">", $match);
                    $str = str_replace($match, $s, $str);
                }
                if (strpos("--" . $match, "<h5")) {
                    $pattern = '/<h5.*?>/i';
                    $s = preg_replace($pattern, "<h5 " . $id_tab . ">", $match);
                    $str = str_replace($match, $s, $str);
                }
                if (strpos("--" . $match, "<h6")) {
                    $pattern = '/<h6.*?>/i';
                    $s = preg_replace($pattern, "<h6 " . $id_tab . ">", $match);
                    $str = str_replace($match, $s, $str);
                }

                $i++;
            }
        }

        return $str;
    }

    public static function renderHtmlContent($content = "", $setting)
    {
        $pattern_span = <<<'regex'
/<\/span>/
regex;
        $str = preg_replace($pattern_span, "", $content);
        $pattern_span = <<<'regex'
/<span.*?>/
regex;
        $str = preg_replace($pattern_span, "", $str);
        $pattern_span = <<<'regex'
/<\/div>/
regex;
        $str = preg_replace($pattern_span, "", $str);
        $pattern_span = <<<'regex'
/<div.*?>/
regex;
        $str = preg_replace($pattern_span, "", $str);
//        $pattern_span = <<<'regex'
//
        /*/<p.*?>/*/
//regex;
//        $str = preg_replace($pattern_span, "<p>", $str);

        //tag heading
        $pattern_span = <<<'regex'

/<h1.*?>/
regex;
        $str = preg_replace($pattern_span, "<h1>", $str);
        $pattern_span = <<<'regex'

/<h2.*?>/
regex;
        $str = preg_replace($pattern_span, "<h2>", $str);
        $pattern_span = <<<'regex'

/<h3.*?>/
regex;
        $str = preg_replace($pattern_span, "<h3>", $str);
        $pattern_span = <<<'regex'

/<h4.*?>/
regex;
        $str = preg_replace($pattern_span, "<h4>", $str);

        preg_match_all('/<h2(.*?)>(.+?)<\/h2>|<h3(.*?)>(.*?)<\/h3>|<h4(.*?)>(.*?)<\/h4>|<h5(.*?)>(.*?)<\/h5>|<h6(.*?)>(.*?)<\/h6>/is', $str, $tach_h);
        $matches = $tach_h[0];
        if (count($matches) > 0) {
            $i = 0;
            foreach ($matches as $key => $match) {
                $ads = "";
                switch ($i) {
                    case 1:
                        $ads = !empty($setting->ads1) ? $setting->ads1 . "<div class='mb-3'></div>" : "";
                        break;
                    case 3:
                        $ads = !empty($setting->ads2) ? $setting->ads2 . "<div class='mb-3'></div>" : "";
                        break;
                    case 5:
                        $ads = !empty($setting->ads3) ? $setting->ads3 . "<div class='mb-3'></div>" : "";
                        break;
                    default:
                        $ads = "";
                        break;
                }

                $id_tab = 'id="position_' . $i . '"';
                if (strpos("--" . $match, "<h1")) {
                    $pattern = '/<h1.*?>/i';
                    $s = preg_replace($pattern, "<h1 " . $id_tab . ">", $match);
                    $str = str_replace($match, $ads . $s, $str);
                }
                if (strpos("--" . $match, "<h2")) {
                    $pattern = '/<h2.*?>/i';
                    $s = preg_replace($pattern, "<h2 " . $id_tab . ">", $match);
                    $str = str_replace($match, $ads . $s, $str);
                }
                if (strpos("--" . $match, "<h3")) {
                    $pattern = '/<h3.*?>/i';
                    $s = preg_replace($pattern, "<h3 " . $id_tab . ">", $match);
                    $str = str_replace($match, $ads . $s, $str);
                }
                if (strpos("--" . $match, "<h4")) {
                    $pattern = '/<h4.*?>/i';
                    $s = preg_replace($pattern, "<h4 " . $id_tab . ">", $match);
                    $str = str_replace($match, $ads . $s, $str);
                }
                if (strpos("--" . $match, "<h5")) {
                    $pattern = '/<h5.*?>/i';
                    $s = preg_replace($pattern, "<h5 " . $id_tab . ">", $match);
                    $str = str_replace($match, $ads . $s, $str);
                }
                if (strpos("--" . $match, "<h6")) {
                    $pattern = '/<h6.*?>/i';
                    $s = preg_replace($pattern, "<h6 " . $id_tab . ">", $match);
                    $str = str_replace($match, $ads . $s, $str);
                }

                $i++;
            }
        }

        return $str;
    }

    public static function formatTime($date = '')
    {
        $plusTime = 0;
        if (App::getLocale() == 'vi') {
            $plusTime = (7 * 60 * 60);
            return date('d/m/Y', (strtotime($date) + $plusTime));
        } else {
            return date('d/m/Y', (strtotime($date) + $plusTime));
        }
    }

    public static function formatDate($date = '')
    {
        $plusTime = 0;
        if (App::getLocale() == 'vi') {
            $plusTime = (7 * 60 * 60);
            return date('d/m/Y', (strtotime($date) + $plusTime));
        } else {
            return date('d/m/Y', (strtotime($date) + $plusTime));
        }
    }

    public static function formatPrice($price)
    {

        $price = preg_replace("/[^0-9\s]/", "", $price);
        $number = explode(".", (string)$price);

        if (count($number) == 1) {
            return ($price > 999) ? str_replace(',', '.', number_format($price)) : $price;
        } else {
            return $price;
        }
    }

    public static function titleAction($data)
    {
        return array(
            'title' => !empty($data[0]) ? $data[0] : '',
            'flag' => !empty($data[1]) ? $data[1] : '',
        );
    }

    public static function metaHead($data)
    {
        return array(
            'title_seo' => !empty(self::lang($data, "title_seo")) ? (!empty($data->ts) ? self::lang($data, "title_seo") . " " . $data->play_last_version : self::lang($data, "title_seo")) : (!empty(self::lang($data, "title")) ? self::lang($data, "title") : ''),
            'meta_key' => !empty(self::lang($data, "meta_key")) ? self::lang($data, "meta_key") : '',
            'meta_des' => !empty(self::lang($data, "meta_des")) ? self::lang($data, "meta_des") : ''
        );
    }

    public static function checkLang($url = "")
    {
        if (!empty($_SESSION["lang"])) {
            $url = str_replace(env("APP_URL"), env("APP_URL") . "/" . str_replace("_", "", $_SESSION["lang"]), $url);
        }
        return $url;
    }

    public static function checkLangSitemap($lang, $url = "")
    {
        if ($lang == "fi") $lang = "ph";
        if (!empty($lang)) {
            $url = str_replace(env("APP_URL"), env("APP_URL") . "/" . str_replace("_", "", $lang), $url);
        }
        $url = str_replace("/id/id", "/id", $url);
        $url = str_replace("/ph/ph", "/ph", $url);
        return $url;
    }

    public static function renderGuard($key = 0)
    {
        $arr = ['admins', 'users'];
        return $arr[$key];
    }

    public static function renderSTT($key, $data)
    {
        $start = ($data->currentPage() - 1) * $data->perPage();
        return $start + $key;
    }

    public static function renderStatus($status = 1)
    {
        $arr = [__('admins::layer.status.no_active'), __('admins::layer.status.active')];
        return !empty($arr[$status]) ? $arr[$status] : 'Empty';
    }

    public static function renderLinkPost($post)
    {
        return route('post.show', ['slug' => $post['link'] . '-' . $post['id']]);
    }

    public static function getTimeToText($createTime, $date_get)
    {
        $createTime = $date_get == "true" ? strtotime($createTime) : $createTime;
        $timeNow = strtotime(date('d-m-Y H:i:s'));
        $timeStatic = (($timeNow - $createTime) / (60));
        $title = '';
        //return date('d-m-Y H:i:s', $timeNow).'-'.date('d-m-Y H:i:s', $createTime).'-'.$timeStatic;
        $timeRound = ceil($timeStatic);
        $timeRoundH = $timeRound / (24 * 60);
        //return $timeRound.'-'.$timeRoundH;
        if ($timeRoundH >= 1) {
            if (round($timeRoundH) >= 30) {
                $ttday = round(round($timeRoundH) / 30);
                if ($ttday >= 12) {
                    $title = round($ttday / 12) . ' năm trước';
                } else {
                    $title = $ttday . ' tháng trước';
                }
            } else {
                $title = ceil($timeRoundH) . ' ngày trước';
            }
        } elseif (($timeRound / 60) >= 1) {
            if (round($timeRound / 60) == 24) {
                $title = '1 ngày trước';
            } else {
                $title = ceil($timeRound / 60) . ' tiếng trước';
            }
        } else {
            if ($timeStatic < 1) $title = 'Mới đăng'; else $title = ceil($timeRound) . ' phút trước';
        }
        return $title;
    }

    public static function strpos_arr($haystack, $needle)
    {
        if (!is_array($needle)) $needle = array($needle);
        foreach ($needle as $what) {
            if (($pos = strpos($haystack, $what)) !== false) return $pos;
        }
        return false;
    }

    public static function renCode($code = '')
    {
        $code = substr(md5($code), 0, 22);
        $code = substr(base64_encode($code), 0, -2);
        return $code;
    }

    public static function renderThumb($url = '', $type = '')
    {
        if (empty($url) || empty($type)) return '1';

        $str = '';
        switch ($type) {
            case 'new_hot':
                $str .= 'w708/h460/fill!';
                break;
            case 'new_list':
                $str .= 'w440/h294/fill!';
                break;
            case 'event_img':
                $str .= 'w1000/fill!';
                break;
            case 'new_list_sk':
                $str .= 'w600/h324/fill!';
                break;
            case 'new_big':
                $str .= 'w723/h615/fill!';
                break;
            case 'manager':
                $str .= 'w305/h305/fill!';
                break;
            case 'covan':
                $str .= 'w460/h415/fill!';
                break;
            case 'product':
                $str .= 'w280/h220/fill!';
                break;
            case 'map':
                $str .= 'w705/h707/fill!';
                break;
            case 'lanhdao':
                $str .= 'w420/400/fill!';
                break;
            case 'product_detail':
                $str .= 'w560/450/fill!';
                break;
            case 'about_ami':
                $str .= 'w355/h280/fill!';
                break;
            case '':
                echo "";
                break;
        }
        return asset(str_replace('storage/', 'img/' . $str, $url));
    }

    public static function shortDesc($str, $len, $charset = 'UTF-8')
    {
        $str = strip_tags($str);
        $str = html_entity_decode($str, ENT_QUOTES, $charset);
        if (mb_strlen($str, $charset) > $len) {
            $arr = explode(' ', $str);
            $str = mb_substr($str, 0, $len, $charset);
            $arrRes = explode(' ', $str);
            $last = $arr[count($arrRes) - 1];
            unset($arr);
            if (strcasecmp($arrRes[count($arrRes) - 1], $last)) {
                unset($arrRes[count($arrRes) - 1]);
            }
            return implode(' ', $arrRes) . "...";
        }
        return $str;
    }

    public static function renderID($slug = '')
    {
        $arr = explode('-', $slug);
        return !empty($arr[count($arr) - 1]) ? $arr[count($arr) - 1] : '';
    }

    public static function hyperlinkContentRegex($str = '')
    {
//        $pattern = <<<'regex'
//|<h[2-3]+>(.*)</h[^>]+>|iU
//regex;
        $pattern = <<<'regex'
|<h[2-3].*>(.*)</h[^>]+>|iU
regex;
        preg_match_all($pattern, $str, $matches);

        //render []
        $arr['html'] = [];
        $arr['data'] = [];
        $arr['content'] = "";
        if (!empty($matches[0])) {
            foreach ($matches[0] as $k => $row) {
                $tmp = '';
                $count = strpos($row, ">");
                $row_fk = $row;
                if ($count > 3) {
                    $tmp = substr($row, 0, $count + 1);
                    $tmp2 = substr($row, 0, 3);
                    $row_fk = str_replace($tmp, $tmp2 . ">", $row);
                }
                if (strpos('tmp' . $row_fk, '<h2>')) $tmp = str_replace('<h2>', '<h2 id="' . Str::slug(strip_tags($row_fk) . '-' . $k) . '">', $row_fk);
                if (strpos('tmp' . $row_fk, '<h3>')) $tmp = str_replace('<h3>', '<h3 id="' . Str::slug(strip_tags($row_fk) . '-' . $k) . '">', $row_fk);
                if (!empty($tmp)) $str = str_replace($row, $tmp, $str);
                $arr['html'][] = $row;
            }
        }

        if (!empty($matches[1])) {
            foreach ($matches[1] as $row) {
                $arr['data'][] = $row;
            }
        }

        $arr['content'] = $str;

        return $arr;

    }

    public static function getIdHeadings($content)
    {
        preg_match('/(?<!_)id=([\'"])?(.*?)\\1/', $content, $matches);
        return isset($matches[2]) ? $matches[2] : '';
    }

    public static function isParent($source, $id)
    {
        $current = $source[$id][2];
        $next = 0;
        if (isset($source[$id + 1][2])) {
            $next = $source[$id + 1][2];
        }
        if ($next > $current) {
            //return true;
        }
        return false;
    }

    public static function split_head($content)
    {
        preg_match_all('/<h2(.*?)>(.+?)<\/h2>|<h3(.*?)>(.*?)<\/h3>|<h4(.*?)>(.*?)<\/h4>|<h5(.*?)>(.*?)<\/h5>|<h6(.*?)>(.*?)<\/h6>/is', $content, $tach_h);
        $matches = $tach_h[0];
        $list = '';
        $current_depth = 7;
        $numbered_items = array();
        $numbered_items_min = null;

        @array_walk($matches, "removelines");
        // find the minimum heading to establish our baseline

        if (count($matches) > 0) {
            foreach ($matches as $i => $match) {
                if ($current_depth > $matches[$i][2]) {
                    $current_depth = (int)$matches[$i][2];
                }
            }
            $numbered_items[$current_depth] = 0;
            $numbered_items_min = 7;
            foreach ($matches as $i => $match) {
                $level = $matches[$i][2];
                if ($level == 2) {
                    $count = $i + 1;
                    $collapse = $button = '';
                    if (self::isParent($matches, $i)) {
                        $collapseCSS = 'collapse';
                        $collapseCSS = 'expand';
                        $collapse = 'ft-has-sub ft-' . $collapseCSS;
                        $button = '<button type="button" class="ft-icon-' . $collapseCSS . '"></button>';
                    }
                    if ($current_depth == (int)$matches[$i][2]) {
                        $list .= '<li class="ft-item ' . $collapse . '">' . $button;
                    }
                    // start lists
                    if ($current_depth != (int)$matches[$i][2]) {
                        for ($current_depth; $current_depth < (int)$matches[$i][2]; $current_depth++) {
                            $numbered_items[$current_depth + 1] = 0;
                            $list .= '<ol class="ft-sub"><li class="ft-item ' . $collapse . '">' . $button;
                        }
                    }
                    $link = self::getIdHeadings($match);
                    $list .= '<a href="#' . $link . '" class="ft-anchor"><span>' . strip_tags($match) . '</span></a>';
                    // end lists
                    if ($i != count($matches) - 1) {
                        if ($current_depth > (int)$matches[$i + 1][2]) {
                            for ($current_depth; $current_depth > (int)$matches[$i + 1][2]; $current_depth--) {
                                $list .= '</li></ol>';
                                $numbered_items[$current_depth] = 0;
                            }
                        }
                        if ($current_depth == (int)@$matches[$i + 1][2]) {
                            $list .= '</li>';
                        }
                    }
                }
            }
        }
        if (!empty($list)) {
            $level = $level - 2;
            $list .= str_repeat("</li></ol>", $level) . '</li>';
        }
        return $list;
    }

    public static function split_content($content)
    {
        preg_match_all('/<h2(.*?)>(.+?)<\/h2>|<h3(.*?)>(.*?)<\/h3>|<h4(.*?)>(.*?)<\/h4>|<h5(.*?)>(.*?)<\/h5>|<h6(.*?)>(.*?)<\/h6>/is', $content, $tach_h);
        $matches_old = $matches = $tach_h[0];
        if (count($matches) > 0) {
            $i = 0;
            foreach ($matches as $key => &$match) {
                $level = $matches[$key][2];
                if ($level == 2) {
                    $i++;
                    $matches[$key] = str_replace('class="ft-heading">', 'class="ft-heading"><span>' . $i . '</span>', $match);
                }
            }
        }
        return str_replace($matches_old, $matches, $content);
    }

    public static function getInfoAppId12($appID = "")
    {
        if (empty($appID)) return [];
        $getHtml = file_get_contents("https://play.google.com/store/apps/details?id=" . $appID);

        //init
        $pattern = <<<'regex'
/<script type="application\/ld\+json".*?>([\s\S]*?)<\/script>/
regex;
        preg_match_all($pattern, $getHtml, $matches);
        $json = !empty($matches[1][0]) ? json_decode($matches[1][0], true) : [];

        //find all scripts
        $pattern = <<<'regex'
/<script nonce.*?>.*?<\/script>/
regex;
        preg_match_all($pattern, $getHtml, $matches_scripts);

        //find script
        $list = [];
        if (!empty($matches_scripts[0])) foreach ($matches_scripts[0] as $values) {
            if (strpos($values, ">AF_initDataCallback(")) {
                $pattern = <<<'regex'
/<script nonce.*?>([\s\S]*?)<\/script>/
regex;
                preg_match_all($pattern, $values, $matches_script);
                if (!empty($matches_script[1][0])) {
                    $str = str_replace("key: '", 'key: "', $matches_script[1][0]);
                    $str = str_replace("', hash: '", '", hash: "', $str);
                    $str = str_replace("', data:", '", data:', $str);
                    $str = str_replace("AF_initDataCallback(", "", str_replace(");", "", $str));
                    $str = str_replace("key:", '"key":', str_replace("hash:", '"hash":', str_replace("data:", '"data":', str_replace("sideChannel:", '"sideChannel":', $str))));
                    $json_arr = @json_decode($str, true);
                    if (!empty($json_arr["key"])) $list[$json_arr["key"]] = $json_arr;
                }
            }
        }

        //version
        $json["info"] = [
            'name' => isset($json["name"]) ? $json["name"] : '',
            'play_cover' => isset($list["ds:4"]["data"][1][2][96][0][3][2]) ? $list["ds:4"]["data"][1][2][96][0][3][2] : (isset($list["ds:4"]["data"][1][2][100][1][0][3][2]) ? $list["ds:4"]["data"][1][2][100][1][0][3][2] : ''),
            'play_image' => isset($list["ds:4"]["data"][1][2][95][0][3][2]) ? $list["ds:4"]["data"][1][2][95][0][3][2] : '',
            'version' => isset($list["ds:4"]["data"][1][2][140][0][0][0]) ? $list["ds:4"]["data"][1][2][140][0][0][0] : '',
            "compatible_with" => isset($list["ds:4"]["data"][1][2][140][1][1][0][0][1]) ? $list["ds:4"]["data"][1][2][140][1][1][0][0][1] . " and up" : '',
            "develop" => isset($json["author"]["name"]) ? $json["author"]["name"] : '',
            "size" => "",
            "mod" => "",
            "url" => "",
            "updated" => isset($list["ds:4"]["data"][1][2][140][2][0][0]) ? @strtotime($list["ds:4"]["data"][1][2][140][2][0][0]) : '',
        ];

        return $json["info"];
    }

    public static function getInfoAppId($appID = "")
    {
        if (empty($appID)) return [];
        $getHtml = file_get_contents("https://play.google.com/store/apps/details?id=" . $appID);

        //init
        $pattern = <<<'regex'
/<script type="application\/ld\+json".*?>([\s\S]*?)<\/script>/
regex;
        preg_match_all($pattern, $getHtml, $matches);
        $json = !empty($matches[1][0]) ? json_decode($matches[1][0], true) : [];

        //find all scripts
        $pattern = <<<'regex'
/<script nonce.*?>.*?<\/script>/
regex;
        preg_match_all($pattern, $getHtml, $matches_scripts);

        //find script
        $list = [];
        if (!empty($matches_scripts[0])) foreach ($matches_scripts[0] as $values) {
            if (strpos($values, ">AF_initDataCallback(")) {
                $pattern = <<<'regex'
/<script nonce.*?>([\s\S]*?)<\/script>/
regex;
                preg_match_all($pattern, $values, $matches_script);
                if (!empty($matches_script[1][0])) {

                    $str = str_replace("key: '", 'key: "', $matches_script[1][0]);
                    $str = str_replace("', hash: '", '", hash: "', $str);
                    $str = str_replace("', data:", '", data:', $str);
                    $str = str_replace("AF_initDataCallback(", "", str_replace(");", "", $str));
                    $str = str_replace("key:", '"key":', str_replace("hash:", '"hash":', str_replace("data:", '"data":', str_replace("sideChannel:", '"sideChannel":', $str))));
                    $json_arr = @json_decode($str, true);
                    if (!empty($json_arr["key"])) $list[$json_arr["key"]] = $json_arr;
                }
            }
        }

        //version
        $ds = "ds:5";
        $json["info"] = [
            'name' => isset($json["name"]) ? $json["name"] : '',
            'play_cover' => isset($list[$ds]["data"][1][2][96][0][3][2]) ? $list[$ds]["data"][1][2][96][0][3][2] : (isset($list[$ds]["data"][1][2][100][1][0][3][2]) ? $list[$ds]["data"][1][2][100][1][0][3][2] : ''),
            'play_image' => isset($list[$ds]["data"][1][2][95][0][3][2]) ? $list[$ds]["data"][1][2][95][0][3][2] : '',
            'version' => isset($list[$ds]["data"][1][2][140][0][0][0]) ? $list[$ds]["data"][1][2][140][0][0][0] : '',
            "compatible_with" => isset($list[$ds]["data"][1][2][140][1][1][0][0][1]) ? $list[$ds]["data"][1][2][140][1][1][0][0][1] . " and up" : 'Android 5.0 and up',
            "develop" => isset($json["author"]["name"]) ? $json["author"]["name"] : '',
            "size" => "",
            "mod" => "",
            "url" => "",
            "updated" => isset($list[$ds]["data"][1][2][140][2][0][0]) ? @strtotime($list[$ds]["data"][1][2][140][2][0][0]) : '',
        ];

        if (empty($json["info"]["version"])) {
            $ds = "ds:9";
            $json["info"]["version"] = isset($list[$ds]["data"][0][0][10]) ? $list[$ds]["data"][0][0][10] : '';
        }

        if (empty($json["info"]["updated"])) {
            $ds = "ds:5";
            $json["info"]["updated"] = isset($list[$ds]["data"][1][2][145][0][0]) ? @strtotime($list[$ds]["data"][1][2][145][0][0]) : '';
        }

        return $json["info"];
    }

    public static function saveJsonRedirect()
    {
        try {
            $model = new RedirectUrl();
            $list = $model->select("id", "url", "url_to", "type")->where("status", 1)->get();
            $list = !empty($list) ? $list->toArray() : [];

            //init
            $file = "redirect.json";
            if (!Storage::disk("store")->exists($file)) {
                Storage::disk("store")->put($file, "");
            }

            //save
            Storage::disk("store")->put($file, @json_encode($list));
        } catch (\Exception $ex) {
        }

    }

    public static function getJsonRedirect()
    {
        $file = "redirect.json";
        $json = Storage::disk("store")->get($file);
        return !empty($json) ? @json_decode($json, true) : [];
    }

    public static function renderHtml($slug, $type, $html)
    {
        try {
            if (empty($slug) || empty($type) || empty($html)) return false;

            //init
            $file = self::renderFileHtml($slug, $type);
            if (!Storage::disk("html_file")->exists($file)) {
                Storage::disk("html_file")->put($file, "");
            }

            Storage::disk("html_file")->put($file, $html);

        } catch (\Exception $ex) {
            //die($ex->getMessage());
        }
    }

    public static function renderHtmlDelete($slug, $type)
    {
        try {
            if (empty($slug) || empty($type)) return false;

            //init
            $file = self::renderFileHtml($slug, $type);
            if (Storage::disk("html_file")->exists($file)) {
                Storage::disk("html_file")->delete($file);
            }

        } catch (\Exception $ex) {
            die($ex->getMessage());
        }
    }

    public static function renderFileHtml($slug, $type)
    {
        return $slug . "-899-" . $type . "-899" . ".html";
    }

    public static function removeHtml()
    {
        try {
//            $storage = Storage::disk('html_file')->allFiles();
//            foreach ($storage as $file) {
//                Storage::disk('html_file')->delete($file);
//            }
        } catch (\Exception $ex) {
            //die($ex->getMessage());
        }
    }

    public static function checkUrlExits($url)
    {
        if (empty($url)) return false;
        $array = get_headers($url);
        $string = $array[0];
        if (strpos($string, "200")) {
            return true;
        } else {
            return false;
        }
    }

    public static function calDate($time)
    {
        $week = array(self::langDefine("Sunday"), self::langDefine("Monday"), self::langDefine("Tuesday"), self::langDefine("Wednesday"), self::langDefine("Thursday"), self::langDefine("Friday"), self::langDefine("Saturday"));
        $w = date('w', $time);
        $day_of_week = $week[$w];
        return $day_of_week . ', ' . date('d/m/Y', $time);
    }

    public static function calDate2($time)
    {
        $week = array(self::langDefine("Sunday"), self::langDefine("Monday"), self::langDefine("Tuesday"), self::langDefine("Wednesday"), self::langDefine("Thursday"), self::langDefine("Friday"), self::langDefine("Saturday"));
        $w = date('w', $time);
        $day_of_week = $week[$w];
        return $day_of_week . ', ' . date('d/m/Y H:i', $time);
    }

}
