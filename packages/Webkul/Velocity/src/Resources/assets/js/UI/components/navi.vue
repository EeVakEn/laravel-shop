<template>
    <ul class="nav-menu">
        <li class="nav-item" v-if="catalogUrl">
            <a class="link" :href="catalogUrl" @click="activeSubmenu=-1">Каталог</a>
        </li>
        <li v-for="(category, index) in categories" :key="index" class="nav-item" @mouseover="showSubmenu(index)" @mouseleave="hideSubmenu(index)">
            <a :href="'/' + category.url_path">
                {{ category.name }}
            </a>
            <transition>

            <div v-if="activeSubmenu===index" :class="'sub-menu sub-menu-' + index">
                <div class="sub-menu-inner">
                    <div>
                        <h2>{{category.name.toUpperCase()}}</h2>
                        <ul>
                            <li v-for="(subcategory, subindex) in category.children" :key="subindex">
                                <a :href="subcategory.url" @mouseover="showSubSubmenu(index, subindex)" @mouseleave="hideSubSubmenu(index, subindex)">
                                    <img :src="subcategory.image" alt="">
                                    <span>{{ subcategory.name }}</span>
                                    <span v-if="subcategory.children.length > 0" class="sub-sub-menu-arrow">&gt;</span>
                                </a>
                                <div v-if="subcategory.children.length > 0" :class="'sub-sub-menu sub-sub-menu-' + index + '-' + subindex">
                                    <ul>
                                        <li v-for="(subsubcategory, subsubindex) in subcategory.children" :key="subsubindex">
                                            <a :href="subsubcategory.url">
                                                <span>{{ subsubcategory.name }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <img :src="category.image_url" alt="">
                    </div>
                </div>
            </div>
            </transition>
        </li>
    </ul>
</template>

<script>
export default {
    props: {
        catalogUrl: {
          type: String,
          required: false,
          default: '',
        },
        categoriesData: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            categories: [],
            activeSubmenu: -1,
        };
    },
    mounted() {
        this.categories = this.categoriesData;
    },
    methods: {
        showSubmenu(index) {
            this.activeSubmenu = index;
        },
        hideSubmenu(index) {
            this.activeSubmenu = -1;
        },
    },
};
</script>

<style scoped>

.nav-menu {
    display: flex;
    justify-content: space-between;
    flex-flow: row nowrap;
    margin: 0;
    padding: 0;
    list-style: none;
}

.nav-item {
    text-align: center;
    width: 100%;
}

.nav-item a {
    cursor: pointer;
    display: block;
    color: #937DC2;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    transition: all 0.3s ease;
}

.nav-item a:hover {
    color: #C689C6;
}

.sub-menu {
    position: absolute;
    top: 43px;
    z-index: 999;
    width: 100%;
    left: 0;
    background: #FFE6F7;
    border-radius: 0 0 15px 15px;
    box-shadow: 4px 4px 8px 0px rgba(34, 60, 80, 0.2);
}

.sub-menu-inner {
    padding: 20px;
    display: grid;
    grid-template-columns: 1fr 1fr;
}

.sub-menu ul {
    margin: 0;
    padding: 10px;
    list-style: none;
}

.sub-menu li {
    margin-right: 20px;
}

.sub-menu a {
    display: flex;
    align-items: center;
    padding: 10px;
    color: #333;
    font-size: 14px;
    font-weight: normal;
    text-decoration: none;
    transition: all 0.3s ease;
}

.sub-menu a:hover {
    color: #000;
    background: #f5f5f5;
}

.sub-menu img {
    border-radius: 15px;
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    aspect-ratio: 1;
    margin-right: 10px;
}


.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>