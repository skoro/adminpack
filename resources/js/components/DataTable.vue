<template>
    <div>
        <slot name="filters">
        </slot>
        <table class="table">
            <thead class="thead-light">
                <slot name="columns" :sort="sort">
                </slot>
            </thead>
            <tbody>
                <tr v-if="loading && !rows.length">
                    <td :colspan="columns.length">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status" aria-hidden="true"></div>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </td>
                </tr>
                <tr v-for="(row, i) in rows" :key="i">
                    <slot name="row" :row="row">
                    </slot>
                </tr>
            </tbody>
        </table>
        <div class="pagination" v-if="pagination">
            <data-pagination
                :pagination="pagination"
                @page="onPage"
            >
            </data-pagination>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        src: {
            type: String,
            required: true
        }
    }, // props

    data() {
        return {
            rows: [],
            sort: {
                column: '',
                order: ''
            },
            page: 1,
            pagination: null,
            loading: true,
            columns: [],
            filters: {},
            ownFilters: []
        }
    }, // data

    mounted() {
        /**
         * Attach callback for data-column and data-filter-* components.
         */
        for (let child of this.$children) {
            const tag = child.$options._componentTag;
            if (tag == 'data-column') {
                this.columns.push(child);
                if (child.order) {
                    this.sort.column = child.name;
                    this.sort.order = child.order;
                }
                child.$on('click', this.onColumnClick);
            }
            else if (tag.startsWith('data-filter-')) {
                this.ownFilters.push(child);
                child.$on('filter', this.onFilter);
            }
        }

        /**
         * Take the table parameters from the current url.
         */
        this.initParams();
        /**
         * Get the data.
         */
        this.getRows();

    }, // mounted

    methods: {

        /**
         * Get the table rows from the remote source.
         */
        async getRows() {
            this.loading = true;
            try {
                const url = this.getUrl(this.src);
                const resp = await axios.get(url);
                this.rows = resp.data.data;
                this.pagination = resp.data.meta;
                /**
                 * Go to the first page when rowset is empty and we are in the middle
                 * of the paging. This often occurs between changing the filters.
                 */
                if (this.rows.length == 0 && this.page > 1) {
                    this.page = 1;
                    this.getRows();
                }
            } catch (e) {
                console.log(e);
            }
            this.loading = false;
        },

        /**
         * Pager callback.
         *
         * @param {int} page
         */
        async onPage(page) {
            this.page = page;
            this.pushState();
            await this.getRows();
        },

        /**
         * Get the data remote url with query parameters.
         *
         * @param {String} base The remote data url without parameters.
         */
        getUrl(base) {
            const url = new URL(base);
            url.searchParams.set('page', this.page);
            if (this.sort.column && this.sort.order) {
                url.searchParams.set('sort', this.sort.column);
                url.searchParams.set('order', this.sort.order);
            }
            Object.keys(this.filters).forEach(key => {
                if (this.filters[key].length) {
                    url.searchParams.set(key, this.filters[key]);
                } else {
                    url.searchParams.delete(key);
                }
            });
            return url.toString();
        },

        /**
         * Update the browser query url parameters.
         */
        pushState() {
            const data = {
                page: this.page,
                sort: this.sort
            };
            const url = this.getUrl(window.location.href);
            window.history.pushState(data, '', url);            
        },

        /**
         * Get values for sorting and filters from the url.
         */
        initParams() {
            const url = new URL(window.location.href);
            const params = url.searchParams;

            // Current data page.
            if (params.has('page')) {
                this.page = params.get('page');
            }

            // Set sort column and its order.
            if (params.has('sort') && params.has('order')) {
                this.updateColumnOrder(params.get('sort'), params.get('order'));
            }

            // Fill filter value.
            const skipKeys = ['page', 'sort', 'order'];
            for (const [key, value] of params) {
                if (skipKeys.indexOf(key) == -1) {
                    this.syncFilter(key, value);
                }
            }
        },
        updateColumnOrder(name, order) {
            for (let col of this.columns) {
                col.order = (col.name != name) ? '' : order;
            }
            this.sort.column = name;
            this.sort.order = order;
        },
        async onColumnClick(column, order) {
            this.updateColumnOrder(column, order);
            this.pushState();
            await this.getRows();
        },

        /**
         * Event callback when the filter changes.
         *
         * @param {string} filter The filter name.
         * @param {string} value  The filter value.
         */
        async onFilter(filter, value) {
            this.filters[filter] = value;
            this.pushState();
            await this.getRows();
        },

        /**
         * Synchronize child filter component with the specified value.
         *
         * @param {string} filter The filter component name.
         * @param {string} value  The filter value.
         * @return {bool}
         */
        syncFilter(filter, value) {
            for (const comp of this.ownFilters) {
                if (comp.filter == filter) {
                    comp.value = value;
                    this.filters[filter] = value;
                    return true;
                }
            }
            return false;
        }
    } // methods
}
</script>