<template>
    <span :class="cssClass">
        <slot></slot>
    </span>
</template>

<script>
export default {
    
    props: {
        /**
         * Badge type: primary, secondary, success, danger, warning, info, light, dark.
         *
         * @see https://getbootstrap.com/docs/4.5/components/badge/#contextual-variations
         */
        type: {
            type: String,
            default: 'primary'
        },

        /**
         * Make badge round.
         *
         * @see https://getbootstrap.com/docs/4.5/components/badge/#pill-badges
         */
        pill: {
            type: Boolean,
            default: false
        }
    },

    computed: {

        /**
         * Makes css classes based on the component's properties.
         */
        cssClass() {
            const classes = ['badge', `badge-${this.type}`];
            if (this.pill) {
                classes.push('badge-pill');
            }
            return classes;
        }
    }
}
</script>