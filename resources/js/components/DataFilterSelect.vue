<template>
    <select class="custom-select" @change="onChange" v-model="value">
        <option
            v-if="empty !== false"
            :value="emptyValue"
            :selected="value == emptyValue"
        >
            {{ empty }}
        </option>
        <option
            v-for="(opt, val) in options"
            :key="opt"
            :selected="val == value"
            :value="val"
        >
            {{ opt }}
        </option>
    </select>
</template>

<script>
export default {
    
    props: {
        /**
         * The filter name.
         * 
         * This name is used by DataTable in a data request.
         */
        filter: {
            type: String,
            required: true
        },

        /**
         * The label for an empty value.
         *
         * Can be disabled by using 'false' value.
         */
        empty: {
            type: [String, Boolean],
            default: 'Choose...'
        },

        /**
         * The empty value. By default, an empty string.
         */
        emptyValue: {
            default: ''
        },

        /**
         * Select options.
         */
        options: {
            type: Object,
            default() {
                return {}
            }
        },

        /**
         * The initial filter value. By default, an empty string.
         */
        initialValue: {
            default: ''
        }
    },

    data() {
        return {
            value: this.initialValue
        }
    },

    methods: {
        onChange() {
            this.$emit('filter', this.filter, this.value);
        }
    }
}
</script>