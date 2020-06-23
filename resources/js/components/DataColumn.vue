<template>
    <th scope="col">
        <a v-if="sortable" href="#" @click.prevent="onClick">
            <slot>{{ name }}</slot>
            <small v-if="order" class="text-muted">
                <i v-if="isDesc" class="fas fa-arrow-down"></i>
                <i v-if="isAsc" class="fas fa-arrow-up"></i>
            </small>
        </a>
        <slot v-else>{{ name }}</slot>
    </th>
</template>

<script>
export default {
    
    props: {
        name: {
            type: String,
            required: true
        },
        sortable: {
            type: Boolean,
            default: true
        },
        sort: {
            type: String,
            default: ''
        }
    },

    data() {
        return {
            order: this.sort
        }
    },

    computed: {
        isAsc() {
            return this.order == 'asc';
        },
        isDesc() {
            return this.order == 'desc';
        }
    },

    methods: {
        invertOrder() {
            let order = this.order;
            if (!order.length) {
                order = 'asc';
            } else if (order == 'asc') {
                order = 'desc';
            } else {
                order = 'asc';
            }
            return order;
        },
        onClick() {
            this.$emit('click', this.name, this.invertOrder());
        }
    } // methods
}
</script>