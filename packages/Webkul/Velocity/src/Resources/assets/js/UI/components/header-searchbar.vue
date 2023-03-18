<template>
    <div class="d-flex flex-row flex-nowrap align-items-center">
        <Transition  name="slide-fade">
            <span v-if="!open && windowWidth >= 993"  @click="open=true;" class="material-icons-outlined header-search-icon">
                search
            </span>
            <div class="btn-group full-width force-center" v-else>
                <div class="selectdiv">
                    <select
                        class="form-control fs13 styled-select"
                        name="category"
                        aria-label="Category"
                        @change="focusInput($event)"
                    >
                        <option value="" v-text="__('header.all-categories')"></option>

                        <template
                            v-for="(category, index) in $root.sharedRootCategories"
                        >
                            <option
                                :key="index"
                                selected="selected"
                                :value="category.id"
                                v-if="category.id == searchedQuery.category"
                                v-text="category.name"
                            >
                            </option>

                            <option
                                :key="index"
                                :value="category.id"
                                v-text="category.name"
                                v-else
                            ></option>
                        </template>
                    </select>

                    <div class="select-icon-container d-inline-block float-right">
                        <span class="select-icon rango-arrow-down"></span>
                    </div>
                </div>

                <input
                    required
                    name="term"
                    type="search"
                    class="form-control"
                    :placeholder="__('header.search-text')"
                    aria-label="Search"
                    v-model:value="inputVal"
                />

                <slot name="image-search"></slot>
                <button
                    class="btn"
                    type="button"
                    id="header-search-icon"
                    aria-label="Search"
                    @click="submitForm"
                >
                    <i class="fs16 fw6 rango-search"></i>
                </button>
            </div>

        </Transition>
    </div>
</template>

<script type="text/javascript">
export default {
    data: function () {
        return {
            open: false,
            inputVal: '',
            searchedQuery: [],
            windowWidth: window.innerWidth
        };
    },

    created: function () {
        let searchedItem = window.location.search.replace('?', '');
        searchedItem = searchedItem.split('&');

        let updatedSearchedCollection = {};

        searchedItem.forEach(item => {
            let splitedItem = item.split('=');
            updatedSearchedCollection[splitedItem[0]] = decodeURI(
                splitedItem[1]
            );
        });

        if (updatedSearchedCollection['image-search'] == 1) {
            updatedSearchedCollection.term = '';
        }

        this.searchedQuery = updatedSearchedCollection;

        if (this.searchedQuery.term) {
            this.inputVal = decodeURIComponent(
                this.searchedQuery.term.split('+').join(' ')
            );
        }
    },

    methods: {
        focusInput: function (event) {
            $(event.target.parentElement.parentElement)
                .find('input')
                .focus();
        },

        submitForm: function () {
            this.open = false;
            if (this.inputVal !== '') {
                $('input[name=term]').val(this.inputVal);
                $('#search-form').submit();
            }
        },
        onResize() {
            this.windowWidth = window.innerWidth
        }
    },
    mounted() {
        this.$nextTick(() => {
            window.addEventListener('resize', this.onResize);
        })
    },

    beforeDestroy() {
        window.removeEventListener('resize', this.onResize);
    },
};
</script>
<style scoped>
.slide-fade-enter-active {
    transition: transform .5s ease-in;
}

.slide-fade-enter, .slide-fade-leave-to{
    transform: translateX(10px);
    opacity: 0;
}
</style>