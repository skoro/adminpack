<template>
    <Badge :type="status ? typeActive : typeDisabled">
        {{ label }}
    </Badge>
</template>

<script>
import Badge from './Badge';

export default {

    components: { Badge },

    props: {

        /**
         * Status value.
         */
        status: {
            type: [String, Boolean, Number],
            required: true
        },

        /**
         * Active label.
         */
        active: {
            type: String,
            default: 'active'
        },

        /**
         * Disabled label.
         */
        disabled: {
            type: String,
            default: 'disabled'
        },

        /**
         * Badge active type.
         */
        typeActive: {
            type: String,
            default: 'success'
        },

        /**
         * Badge disabled type.
         */
        typeDisabled: {
            type: String,
            default: 'disabled'
        }
    },

    computed: {
        label() {
            return this.status ? this.active : this.disabled;
        }
    }

}
</script>