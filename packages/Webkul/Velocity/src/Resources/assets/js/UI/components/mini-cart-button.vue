<template>
    <button
        type="button"
        id="mini-cart"
        @click="toggleMiniCart"
        :class="
            `btn btn-link disable-box-shadow ${
                itemCount == 0 ? 'cursor-not-allowed' : ''
            }`
        "
    >
        <div class="mini-cart-content">
            <i class="material-icons-outlined text-down-3">local_mall</i>
            <span class="badge" v-text="itemCount" v-if="itemCount != 0"></span>
        </div>
    </button>
</template>

<script>
export default {
    props: ['itemCount', 'cartText'],

    methods: {
        toggleMiniCart: function() {
            let modal = $('#cart-modal-content')[0];

            if (modal) modal.classList.toggle('hide');

            let accountModal = $('.account-modal')[0];

            if (accountModal) accountModal.classList.add('hide');

            event.stopPropagation();
        }
    }
};
</script>
