<template>
    <div class="input-group">
        <input
            type="text"
            class="form-control"
            :placeholder="desc"
            v-model="value"
            @keyup.enter="doClick"
        />
        <div class="input-group-append">
            <button
                type="button"
                class="btn btn-outline-secondary"
                :disabled="isEmptyInput"
                @click="doClear"
            >
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-backspace-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2V3zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8 5.829 5.854z"/>
                </svg>
            </button>
            <button
                type="button"
                class="btn btn-outline-secondary"
                :disabled="isEmptyInput"
                @click="doClick"
            >
                {{ button }}
            </button>
        </div>
    </div>
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
         * The filter description in the input placeholder.
         */
        desc: {
            type: String,
            default: ''
        },

        /**
         * The action button label. By default, "Search".
         */
        button: {
            type: String,
            default: 'Search...'
        },
        
        /**
         * The initial filter value. By default, an empty string.
         */
         initialValue: {
            type: String,
            default: ''
        }
    },

    data() {
        return {
            value: this.initialValue
        }
    },

    computed: {
        isEmptyInput() {
            return ! this.value.trim().length;
        }
    },

    methods: {
        doClick() {
            this.$emit('filter', this.filter, this.value);
        },
        doClear() {
            this.value = '';
            this.doClick();
        }
    }
}    
</script>