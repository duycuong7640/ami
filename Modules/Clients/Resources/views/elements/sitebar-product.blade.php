<nav id="site-bar-product">
    @if(!empty($data['list_menu']))
        <div class="wrap-site-bar-product">
            <label>{{ \App\Helpers\Helpers::langDefine("Useful links") }}</label>
            <ul>
                @foreach($data['link'] as $row)
                    <li>
                        {!! \App\Helpers\Helpers::lang($row, "title") !!}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="wrap-site-bar-product">
        <label>Games / Apps</label>
        <ul>
            @foreach($data_common['top_products'] as $row)
                @php
                    $row->title = $row->title . " ". $row->type_game . " ". $row->play_last_version . " (". $row->mod_d.")";
                    $row->title_es = $row->title_es . " ". $row->type_game . " ". $row->play_last_version . " (". $row->mod_d_es.")";
                    $row->title_pt = $row->title_pt . " ". $row->type_game . " ". $row->play_last_version . " (". $row->mod_d_pt.")";
                @endphp
                <li>
                    <div class="sbp-item">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                                <a href="{{ route('client.product.show', ['slug' => $row->slug]) }}"
                                   title="{{ \App\Helpers\Helpers::lang($row, "title") }}" rel="dofollow sponsored">
                                    @if(!empty($row->thumbnail))
                                        <img class="img-play-image-right"
                                             src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_product') }}"
                                             title="{{ \App\Helpers\Helpers::lang($row, "title") }}"
                                             alt="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                    @else
                                        <img class="img-play-image-right" src="{{ $row->play_image }}"
                                             title="{{ \App\Helpers\Helpers::lang($row, "title") }}"
                                             alt="{{ \App\Helpers\Helpers::lang($row, "title") }}">
                                    @endif
                                </a>

                            </div>
                            <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                                <div class="mt-1 pl-3">
                                    <div class="name-sp">
                                        <h3>
                                            <a href="{{ route('client.product.show', ['slug' => $row->slug]) }}"
                                               title="{{ \App\Helpers\Helpers::lang($row, "title") }}"
                                               rel="dofollow sponsored">
                                                {{ \App\Helpers\Helpers::lang($row, "title") }}
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                </li>
            @endforeach
        </ul>
    </div>

</nav>