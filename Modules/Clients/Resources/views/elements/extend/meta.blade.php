<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<?php
$lang = isset($_SESSION["lang"]) ? $_SESSION["lang"] : "";
?>
@if(!$data_common['setting']->status_gooogleindex)
    <meta name="robots" content="noindex"/>
    <meta name="AdsBot-Google" content="noindex"/>
@else
    @if(!empty($data['detail']->id))
        @if(empty($lang))
            @if(!$data['detail']->choose_4)
                <meta name="robots" content="noindex"/>
                <meta name="AdsBot-Google" content="noindex"/>
            @endif
        @elseif($lang == "_es")
            @if(!$data['detail']->choose_6)
                <meta name="robots" content="noindex"/>
                <meta name="AdsBot-Google" content="noindex"/>
            @endif
        @elseif($lang == "_pt")
            @if(!$data['detail']->choose_7)
                <meta name="robots" content="noindex"/>
                <meta name="AdsBot-Google" content="noindex"/>
            @endif
        @elseif($lang == "_id")
            @if(!$data['detail']->choose_8)
                <meta name="robots" content="noindex"/>
                <meta name="AdsBot-Google" content="noindex"/>
            @endif
        @elseif($lang == "_ph")
            @if(!$data['detail']->choose_9)
                <meta name="robots" content="noindex"/>
                <meta name="AdsBot-Google" content="noindex"/>
            @endif
        @endif
    @endif
@endif
<link type="image/x-icon" href="{{ asset('/static/client/images/fav.jpg') }}" rel="icon"/>
<link type="image/x-icon" href="{{ asset('/static/client/images/fav.jpg') }}" rel="shortcut icon"/>
<title>{{ !empty($data['common']['title_seo']) ? $data['common']['title_seo'] : '' }}</title>
<meta name="keywords" content="{{ !empty($data['common']['meta_key']) ? $data['common']['meta_key'] : '' }}"/>
<meta name="description" content="{{ !empty($data['common']['meta_des']) ? $data['common']['meta_des'] : '' }}"/>

<?php
$title = !empty($data['detail']->title) ? $data['detail']->title : (!empty($data['common']['title_seo']) ? $data['common']['title_seo'] : '');
$description = !empty($data['detail']->description) ? $data['detail']->description : (!empty($data['common']['meta_des']) ? $data['common']['meta_des'] : '');
$img = '';
if (!empty($data['detail']->id)) {
    $img = \App\Helpers\Helpers::renderThumb($data['detail']->thumbnail, 'share_fb');
} else {
    if (!empty($data['slide'])) foreach ($data['slide'] as $k => $row) {
        $img = \App\Helpers\Helpers::renderThumb($row->thumbnail, 'share_fb');
        break;
    }
}

?>
<meta property="og:url" content="<?php echo url()->current(); ?>"/>
<meta property="og:title" content="{{ $title }}"/>
<meta property="og:description" content="{{ trim(strip_tags($description))  }}"/>
<meta property="og:type" content="article"/>
<meta property="og:image" content="{{ $img }}"/>
<meta property="og:locale" content="en">
<meta property="og:locale:alternate" content="id">
<meta property="og:locale:alternate" content="ph">
<meta property="og:locale:alternate" content="fi">
<link rel="alternate" hreflang="en" href="{{ asset("") }}">
<link rel="alternate" hreflang="id-ID" href="{{ asset("/id") }}">
<link rel="alternate" hreflang="ph-PH" href="{{ asset("/ph") }}">
<link rel="alternate" hreflang="fi" href="{{ asset("/ph") }}">
<link rel="canonical" href="{{ !empty($data['full_url']) ? $data['full_url'] : '' }}">
{!! !empty($data_common['setting']->code_header) ? $data_common['setting']->code_header : '' !!}
