@extends('clients::layouts.new')

@section('content')
    <section class="wrap-about-ami">
        <section class="wrap-cate">
            <div class="main-width">
                <h1>{{ !empty(\App\Helpers\Helpers::lang($data['category'], "title2")) ? \App\Helpers\Helpers::lang($data['category'], "title2") : \App\Helpers\Helpers::lang($data['category'], "title") }}</h1>
                <div class="cate-des">
                    {!! \App\Helpers\Helpers::lang($data['category'], "description") !!}
                </div>
            </div>
        </section>
        <section class="wrap-ex-one">
            <div class="main-width">
                <div class="ex-des">
                    {!! \App\Helpers\Helpers::lang($data['category'], "description2") !!}
                </div>
            </div>
        </section>
        <section class="wrap-distributors">
            <div class="main-width">
                <div class="head">{{ \App\Helpers\Helpers::langDefine('NHÀ PHÂN PHỐI DẪN ĐẦU') }}</div>
                <div class="wrap-list-distributors">
                    <ul>
                        @foreach($data['list'] as $k=>$row)
                            <li>
                                <div class="item">
                                    <div class="content-data">
                                        <a href="" title="">
                                            <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'lanhdao') }}"
                                                 title="" alt=""/>
                                        </a>
                                        <h3 class="title">{{ \App\Helpers\Helpers::lang($row, "title") }}</h3>
                                        <div class="shortdes">{{ \App\Helpers\Helpers::shortDesc(\App\Helpers\Helpers::lang($row, "description"), 35) }}</div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </section>
@endsection
