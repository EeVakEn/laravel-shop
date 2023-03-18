@if ($velocityMetaData && $velocityMetaData->slider)
    <div class="slider-container">
        <slider-component
            direction="{{ core()->getCurrentLocale()->direction }}"
            default-banner="{{ asset('/themes/velocity/assets/images/video-back.mp4') }}"
            :banners="{{ json_encode($sliderData) }}">

            {{-- this is default content if js is not loaded --}}
            @if(! empty($sliderData))
                <img class="col-12 no-padding banner-icon" src="{{ Storage::url($sliderData[0]['path']) }}" alt=""/>
            @else
                <video v-else autoplay loop muted playsinline>
                    <source class="col-12 no-padding banner-icon" src="{{asset('/themes/velocity/assets/images/video-back.mp4')}})" type="video/mp4">
                </video>
            @endif

        </slider-component>
    </div>
@endif
