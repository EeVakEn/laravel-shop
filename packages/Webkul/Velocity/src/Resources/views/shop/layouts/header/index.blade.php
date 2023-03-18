<header class="sticky-header">
    <div class="row justify-content-between h-100 align-items-center flex-nowrap px-3">
        <a class="left navbar-brand" href="{{ route('shop.home.index') }}" aria-label="Logo">
            <img class="logo"
                 src="{{ core()->getCurrentChannel()->logo_url ?? asset('themes/velocity/assets/images/logo-text.png') }}"
                 alt=""/>
        </a>

        <div class="position-relative w-50">
            @php
                $categories = [];

                foreach (app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id) as $category) {
                    if ($category->slug)
                    array_push($categories, $category);
                }
            @endphp
            <navi
                :categories-data="{{ json_encode($categories) }}"
                catalog-url="{{route('shop.search.index')}}"
            >
            </navi>
        </div>

        <div class="right mx-3">
            <div class="left-wrapper">

                @include('velocity::shop.layouts.particals.search-bar')

                @include('velocity::layouts.top-nav.login-section')

                {!! view_render_event('bagisto.shop.layout.header.wishlist.before') !!}

                @include('velocity::shop.layouts.particals.wishlist', ['isText' => true])

                {!! view_render_event('bagisto.shop.layout.header.wishlist.after') !!}

                {!! view_render_event('bagisto.shop.layout.header.cart-item.before') !!}

                @include('shop::checkout.cart.mini-cart')

                {!! view_render_event('bagisto.shop.layout.header.cart-item.after') !!}
            </div>
        </div>
    </div>
</header>

@push('scripts')
    <script type="text/javascript">
        (() => {
            document.addEventListener('scroll', e => {
                scrollPosition = Math.round(window.scrollY);

                if (scrollPosition > 50) {
                    document.querySelector('header').classList.add('header-shadow');
                } else {
                    document.querySelector('header').classList.remove('header-shadow');
                }
            });
        })();
    </script>
@endpush
