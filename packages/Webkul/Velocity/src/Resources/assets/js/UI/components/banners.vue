<template>
    <div :class="`slides-container ${direction}`">
        <carousel-component
            loop="true"
            timeout="5000"
            autoplay="true"
            slides-per-page="1"
            navigation-enabled="hide"
            paginationEnabled="hide"
            :locale-direction="direction"
            :slides-count="banners.length > 0 ? banners.length : 1"
        >
            <template v-if="banners.length > 0">
                <slide
                    v-for="(banner, index) in banners"
                    :key="index"
                    :slot="`slide-${index}`"
                    title=" "
                >
                    <a
                        :href="
                            banner.slider_path != ''
                                ? banner.slider_path
                                : 'javascript:void(0);'
                        "
                    >

                        <img v-if="!banner.image_url"
                            class="col-12 no-padding banner-icon"
                            :src="banner.image_url"
                        />
                        <video v-else autoplay loop muted playsinline>
                            <source class="col-12 no-padding banner-icon" :src="defaultBanner" type="video/mp4">
                        </video>

                        <div
                            class="show-content"
                            v-html="banner.content.replace('\r\n', '')"
                        ></div>
                    </a>
                </slide>
            </template>

            <template v-else>
                <slide slot="slide-0">
                    <div class="gradient-layout">
                        <div class="content">
                            <h1>Little bunny</h1>
                            <h2>Магазин детской одежды с доставкой по всей России</h2>
                            <a class="theme-btn" href="/search">Каталог</a>
                        </div>
                        <video autoplay loop muted playsinline ref="video" class="back-video">
                            <source class="col-12 no-padding banner-icon" :src="defaultBanner" type="video/mp4">
                        </video>
                    </div>
                </slide>
            </template>
        </carousel-component>
    </div>
</template>

<script>
export default {
    props: ['direction', 'defaultBanner', 'banners'],

    mounted: function() {
        let banners = this.$el.querySelectorAll('img');
        banners.forEach(banner => {
            banner.style.display = 'block';
        });
        document.querySelector('video').defaultPlaybackRate=2.0;
        document.querySelector('video').play();
        // this.$refs.video.playbackRate=2;
    }
};
</script>
