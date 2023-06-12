@extends('clients::layouts.cart')

@section('content')
    <section id="cart-success">
        <label class="title-suc">{{ !empty($data['common']['title_seo']) ? $data['common']['title_seo'] : '' }}</label>
        <div class="ct">
            <div class="mt-1 mb-4 ctct">
                {!! $data_common['setting']->content_pay_suc !!}
            </div>
        </div>
    </section>
@endsection