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
        <section class="wrap-locations">
            <div class="main-width">
                <div class="wrap-show-localtions">
                    <ul>
                        @php $i = 0; @endphp
                        @foreach($data['newpost'] as $k=>$row)
                            @if($i%2===0)
                                <li>
                                    <div class="item">
                                        <div class="info">
                                            <div class="title">{{ \App\Helpers\Helpers::lang($row, 'title') }}</div>
                                            <div class="shortdes">
                                                {!! \App\Helpers\Helpers::lang($row, 'description') !!}
                                            </div>
                                        </div>
                                        <div class="google-map">
                                            {!! $row->content !!}
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'map') }}"
                                         title="{{ \App\Helpers\Helpers::lang($row, 'title') }}" alt="{{ \App\Helpers\Helpers::lang($row, 'title') }}"/>
                                </li>
                            @else
                                <li>
                                    <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'map') }}"
                                         title="{{ \App\Helpers\Helpers::lang($row, 'title') }}" alt="{{ \App\Helpers\Helpers::lang($row, 'title') }}"/>
                                </li>
                                <li>
                                    <div class="item">
                                        <div class="info">
                                            <div class="title">{{ \App\Helpers\Helpers::lang($row, 'title') }}</div>
                                            <div class="shortdes">
                                                {!! \App\Helpers\Helpers::lang($row, 'description') !!}
                                            </div>
                                        </div>
                                        <div class="google-map">
                                            {!! $row->content !!}
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @php $i ++; @endphp
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </section>
@endsection
