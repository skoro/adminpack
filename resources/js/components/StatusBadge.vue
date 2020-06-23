<template>
    <span
        class="badge"
        :class="{ 'badge-success': value, 'badge-secondary': !value }"
    >
        {{ label }}
    </span>
</template>

<script>
export default {

    props: {
        value: {
            type: [String, Boolean, Number],
            required: true
        },
        labelActive: {
            type: String,
            default: 'active'
        },
        labelDisabled: {
            type: String,
            default: 'disabled'
        }
    },

    computed: {
        label() {
            return this.value ? this.labelActive : this.labelDisabled;
        }
    }

}
</script>