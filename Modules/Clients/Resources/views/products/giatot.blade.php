@extends('clients::layouts.product')

@section('content')
    <section id="wrap-product-category">
        <div class="pc-head">
            <h1>Giá tốt mỗi ngày</h1>
        </div>
        <div class="pc-content">
            <ul>
                @foreach($data['list'] as $row)
                    <li>
                        <div class="pr-item">
                            <a href="{{ route('client.product.show', ['slug' => $row->slug.'-'.$row->id]) }}"
                               title="{{ $row->title }}" rel="nofollow sponsored">
                                <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_product') }}"
                                     title="{{ $row->title }}" alt="{{ $row->title }}">
                            </a>
                            <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}</p>
                            <div class="name-sp">
                                <h2>
                                    <a href="{{ route('client.product.show', ['slug' => $row->slug.'-'.$row->id]) }}"
                                       title="{{ $row->title }}" rel="nofollow sponsored">
                                        {{ $row->title }}
                                    </a>
                                </h2>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        {{ !empty($data['list']) ? $data['list']->links('clients::elements.extend.pagination') : "" }}
    </section>
@endsection
