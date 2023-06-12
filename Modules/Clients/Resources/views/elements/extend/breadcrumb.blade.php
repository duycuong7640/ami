<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">{{ \App\Helpers\Helpers::langDefine("Home") }}</a></li>
        @if(!empty($data['detail']->title))
            @if(!empty($data['cate_parent']->id))
                <li class="breadcrumb-item"><a
                            href="{{ route('client.category.index', ['slug' => $data['cate_parent']->slug]) }}">{{ \App\Helpers\Helpers::lang($data['cate_parent'], "title") }}</a>
                </li>
            @endif
            <li class="breadcrumb-item"><a
                        href="{{ route('client.category.index', ['slug' => $data['detail']->category_slug]) }}">{{ \App\Helpers\Helpers::lang($data['detail'], "category_title") }}</a>
            </li>
            <li class="breadcrumb-item active"
                aria-current="page">{{ !empty(\App\Helpers\Helpers::lang($data['detail'], "title3")) ? \App\Helpers\Helpers::lang($data['detail'], "title3") : \App\Helpers\Helpers::lang($data['detail'], "title") }}</li>
        @endif
        @if(!empty($data['category']->id))
            <li class="breadcrumb-item active"
                aria-current="page">{{ \App\Helpers\Helpers::lang($data['category'], "title") }}</li>
        @endif
        @if(!empty($data_common['page_user']))
            <li class="breadcrumb-item active"
                aria-current="page">{{ !empty($data['common']['title_seo']) ? $data['common']['title_seo'] : '' }}</li>
        @endif
    </ol>
</nav>