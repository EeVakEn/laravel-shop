@php
    $isRendered = false;
    $advertisementFour = null;
    $isLazyLoad = ! isset($lazyload) ? true : ( $lazyload ? true : false );
@endphp

@if ($velocityMetaData && $velocityMetaData->advertisement)
    @php
        $advertisement = json_decode($velocityMetaData->advertisement, true);

        if (isset($advertisement[4]) && is_array($advertisement[4])) {
            $advertisementFour = array_values(array_filter($advertisement[4]));
        }
    @endphp

    @if ($advertisementFour)
        @php
            $isRendered = true;
        @endphp


    @endif
@endif

@if (! $isRendered)
    <div class="container-fluid advertisement-four-container">
        <div class="row">
            <div class="col-lg-4 col-12 advertisement-container-block no-padding">
                <a @if (isset($one)) href="{{ $one }}" @endif aria-label="Advertisement">
                    <img
                        class="{{ $isLazyLoad ? 'lazyload' : '' }}"
                        @if (! $isLazyLoad) src="{{ asset('/themes/velocity/assets/images/big-sale-banner.webp') }}" @endif
                        data-src="{{ asset('/themes/velocity/assets/images/big-sale-banner.webp') }}" alt="" />
                </a>
            </div>

            <div class="col-lg-4 col-12 advertisement-container-block offers-ct-panel">
                <a @if (isset($two)) href="{{ $two }}" @endif aria-label="Advertisement">
                    <img
                        class="offers-ct-top {{ $isLazyLoad ? 'lazyload' : '' }}"
                        @if (! $isLazyLoad) src="{{ asset('/themes/velocity/assets/images/seasons.webp') }}" @endif
                        data-src="{{ asset('/themes/velocity/assets/images/seasons.webp') }}" alt="" />
                </a>

                <div style="height: 10px;"></div>

                <a @if (isset($three)) href="{{ $three }}" @endif aria-label="Advertisement">
                    <img
                        class="offers-ct-bottom {{ $isLazyLoad ? 'lazyload' : '' }}"
                        @if (! $isLazyLoad) src="{{ asset('/themes/velocity/assets/images/deals.webp') }}" @endif
                        data-src="{{ asset('/themes/velocity/assets/images/deals.webp') }}" alt="" />
                </a>
            </div>

            <div class="col-lg-4 col-12 advertisement-container-block no-padding">
                <a @if (isset($four)) href="{{ $four }}" @endif aria-label="Advertisement">
                    <img
                        class="{{ $isLazyLoad ? 'lazyload' : '' }}"
                        @if (! $isLazyLoad) src="{{ asset('/themes/velocity/assets/images/kids.webp') }}" @endif
                        data-src="{{ asset('/themes/velocity/assets/images/kids.webp') }}" alt="" />
                </a>
            </div>
        </div>
    </div>
@endif