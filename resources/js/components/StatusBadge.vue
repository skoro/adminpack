<template>
    <BadgeLabel :type="status ? typeActive : typeDisabled">
        {{ label }}
    </BadgeLabel>
</template>

<script>
import BadgeLabel from './BadgeLabel';

export default {

    components: { BadgeLabel },

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
            default: 'secondary'
        }
    },

    computed: {
        label() {
            return this.status ? this.active : this.disabled;
        }
    }

}
</script>