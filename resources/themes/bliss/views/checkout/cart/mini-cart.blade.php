<?php $cart = cart()->getCart(); ?>

<?php $items = !empty($cart) ? $cart->items : []; ?>

<div class="dropdown-toggle">
    <a class="cart-link" href="{{ route('shop.checkout.cart.index') }}">
        <i class="fa fa-xl fa-cart-shopping"></i>
    </a>
    <span class="count">{{ empty($items)? 0 :$items->count() }}</span>
</div>

<div class="dropdown-list" style="display: none; top: 52px; right: 0px;">
    <div class="dropdown-container">
        <div class="dropdown-cart">
            <div class="dropdown-header">
                <h4>{{ __('shop::app.header.cart') }}</h4>
                @if(!empty($cart))
                    <p class="heading">
                        {{ __('shop::app.checkout.cart.cart-subtotal') }} -
                        {!! view_render_event('bagisto.shop.checkout.cart-mini.subtotal.before', ['cart' => $cart]) !!}

                        @if (Webkul\Tax\Helpers\Tax::isTaxInclusive())
                            <b>{{ core()->currency($cart->base_grand_total) }}</b>
                        @else
                            <b>{{ core()->currency($cart->base_sub_total) }}</b>
                        @endif

                        {!! view_render_event('bagisto.shop.checkout.cart-mini.subtotal.after', ['cart' => $cart]) !!}
                    </p>
                @endif
            </div>

            <div class="dropdown-content">
                @foreach ($items as $item)

                    <div class="item">
                        <div class="item-image">
                            @php
                                $images = $item->product->getTypeInstance()->getBaseImage($item);
                            @endphp
                            <img src="{{ $images['small_image_url'] }}" alt=""/>
                        </div>

                        <div class="item-details">
                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.name.before', ['item' => $item]) !!}

                            <div class="item-name">{{ $item->name }}</div>

                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.name.after', ['item' => $item]) !!}


                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.options.before', ['item' => $item]) !!}

                            @if (isset($item->additional['attributes']))
                                <div class="item-options">

                                    @foreach ($item->additional['attributes'] as $attribute)
                                        <b>{{ $attribute['attribute_name'] }}
                                            : </b>{{ $attribute['option_label'] }}</br>
                                    @endforeach

                                </div>
                            @endif

                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.options.after', ['item' => $item]) !!}


                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.price.before', ['item' => $item]) !!}

                            <div class="item-price">
                                @if (Webkul\Tax\Helpers\Tax::isTaxInclusive())
                                    <b>{{ core()->currency($item->base_total + $item->tax_amount) }}</b>
                                @else
                                    <b>{{ core()->currency($item->base_total) }}</b>
                                @endif
                            </div>

                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.price.after', ['item' => $item]) !!}


                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.quantity.before', ['item' => $item]) !!}

                            <div class="item-qty">{{__('shop::app.minicart.quantity')}} : {{ $item->quantity }}</div>

                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.quantity.after', ['item' => $item]) !!}

                        </div>
                        <div class="item-remove">
                            <a href="{{ route('shop.checkout.cart.remove', $item->id) }}"
                               onclick="removeLink('{{ __('shop::app.checkout.cart.cart-remove-action') }}')"><i
                                    class="icon trash-icon"></i> </a>
                        </div>
                    </div>

                @endforeach
                @if(empty($cart))
                    <div class="item">
                        <span>Корзина пуста, добавьте товары в корзину.
                            <a href="{{route('shop.search.index')}}" class="btn btn-primary">Посмотреть каталог</a>
                        </span>
                    </div>
                @endif
            </div>
            @if(!empty($cart))
                <div class="dropdown-footer">
                    <a href="{{ route('shop.checkout.cart.index') }}">{{ __('shop::app.minicart.view-cart') }}</a>

                    @php
                        $minimumOrderAmount = (float) core()->getConfigData('sales.orderSettings.minimum-order.minimum_order_amount') ?? 0;
                    @endphp

                    <proceed-to-checkout
                        href="{{ route('shop.checkout.onepage.index') }}"
                        add-class="btn btn-primary"
                        text="{{ __('shop::app.minicart.checkout') }}"
                        is-minimum-order-completed="{{ $cart->checkMinimumOrder() }}"
                        minimum-order-message="{{ __('shop::app.checkout.cart.minimum-order-message', ['amount' => core()->currency($minimumOrderAmount)]) }}"
                        style="color: white;">
                    </proceed-to-checkout>
                </div>
            @endif
        </div>
    </div>
</div>

