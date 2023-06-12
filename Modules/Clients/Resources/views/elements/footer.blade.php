<section class="bts">
    <div class="main-width">
        <img src="{{ asset('web/images/bts.png') }}">
    </div>
</section>
<footer id="footer">
    <div class="main-width">
        <div class="wrap-box">
            <div class="box cal-b-ft">
                <div class="cate-title">
                    Kết nối với Ami
                </div>
                <div class="icon-connect">
                    <ul>
                        <li>
                            <a href="" target="_blank">
                                <img src="{{ asset('web/images/icon/fb.svg') }}" title="" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="" target="_blank">
                                <img src="{{ asset('web/images/icon/google.svg') }}" title="" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="" target="_blank">
                                <img src="{{ asset('web/images/icon/youtube.svg') }}" title="" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="" target="_blank">
                                <img src="{{ asset('web/images/icon/instagram.svg') }}" title="" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
                @if(!empty($data_common['category_list']['arrList']['parent']))
                @php $dem = 0; @endphp
                @foreach($data_common['category_list']['arrList']['parent'] as $k=>$row)
                    @if(in_array($row['id'], ['1', '2', '3']))
{{--                    @if($dem < 3)--}}
                        <div class="box cal-b-ft">
                            <div class="cate-title">
                                <a href="{{ asset($row['slug']) }}"
                                   title="{{ \App\Helpers\Helpers::langArr($row, "title") }}">{{ \App\Helpers\Helpers::langArr($row, "title") }}</a>
                            </div>
                            @if(!empty($data_common['category_list']['arrList']['list'][$row['id']]))
                                <div class="cate-ft-list">
                                    <ul>
                                        @foreach($data_common['category_list']['arrList']['list'][$row['id']] as $key=>$r)
                                            <li><a href="{{ asset($r['slug']) }}"
                                                   title="{{ \App\Helpers\Helpers::langArr($r, "title") }}">{{ \App\Helpers\Helpers::langArr($r, "title") }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
{{--                    @endif--}}
                    @php $dem ++; @endphp
                    @endif
                @endforeach
            @endif
            <div class="box cal-b-ft">
                <div class="cate-title">
                    Liên hệ
                </div>
                <div class="footer-contact">
                    {!! !empty($data_common['setting']->content_footer) ? $data_common['setting']->content_footer : '' !!}
                </div>
            </div>
        </div>
        <div class="wrap-footer-ex">
            <div class="ex-left">{!! !empty($data_common['setting']->copyright) ? $data_common['setting']->copyright : '' !!}</div>
            <div class="ex-right">
                <ul>
                    @if(!empty($data_common['category_list_footer']))
                        @foreach($data_common['category_list_footer'] as $row)
                            <li>
                                <a href="{{ route('client.category.index', ['slug' => $row->slug]) }}" title="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                    {{ \App\Helpers\Helpers::lang($row, "title") }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</footer>

{!! !empty($data_common['setting']->code_footer) ? $data_common['setting']->code_footer : '' !!}