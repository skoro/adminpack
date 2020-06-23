<template>
    <nav aria-label="Pagination">
        <ul class="pagination">

            <li class="page-item" :class="{ disabled: isFirst }">
                <a
                    v-if="!isFirst"
                    class="page-link"
                    :href="pageLink(prevPage)"
                    :aria-label="labelPrevious"
                    @click.prevent="switchPage(prevPage)"
                >
                    {{ labelPrevious }}
                </a>
                <span v-if="isFirst" class="page-link">
                    {{ labelPrevious }}
                </span>
            </li>

            <li
                v-for="p in pagination.last_page"
                class="page-item"
                :class="{ active: isActive(p) }"
                :key="p"
            >
                <a
                    class="page-link"
                    :href="pageLink(p)"
                    @click.prevent="switchPage(p)"
                >
                    {{ p }}
                </a>
            </li>

            <li class="page-item" :class="{ disabled: isLast }">
                <a
                    v-if="!isLast"
                    class="page-link"
                    :href="pageLink(nextPage)"
                    :aria-label="labelNext"
                    @click.prevent="switchPage(nextPage)"
                >
                    {{ labelNext }}
                </a>
                <span v-if="isLast" class="page-link">
                    {{ labelNext }}
                </span>
            </li>

        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        pagination: {
            type: Object,
            required: true
        },
        labelPrevious: {
            type: String,
            default: 'Previous'
        },
        labelNext: {
            type: String,
            default: 'Next'
        }
    },

    data() {
        return {
        }
    },

    computed: {
        isFirst() {
            return this.pagination.current_page == 1;
        },
        isLast() {
            return this.pagination.current_page == this.pagination.last_page;
        },
        nextPage() {
            return this.pagination.current_page + 1;
        },
        prevPage() {
            return this.pagination.current_page - 1;
        }
    }, // computed

    created() {
    },

    methods: {
        isActive(page) {
            return this.pagination.current_page == page;
        },
        pageLink(page) {
            const url = new URL(window.location.href);
            url.searchParams.set('page', page);
            return url.toString();
        },
        switchPage(page) {
            const link = this.pageLink(page);
            this.$emit('page', page, link);
        }
    } // methods
}
</script>