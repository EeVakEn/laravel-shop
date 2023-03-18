<template>
    <div
        id="quick-view-btn-container"
        class="quick-view-btn-container"
        @click="openQuickView({event: $event})">



        <button type="button"><span class="material-icons-outlined">visibility</span> {{ __('products.quick-view') }}</button>
    </div>
</template>

<script type="text/javascript">
    export default {
        props: ['quickViewDetails'],

        methods: {
            openQuickView: function ({event}) {
                event.preventDefault();
                event.stopPropagation();

                this.$root.quickView = true;
                this.$root.productDetails = this.quickViewDetails;

                $('body').toggleClass('overflow-hidden');
            },
        }
    }
</script>