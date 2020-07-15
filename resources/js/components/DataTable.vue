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
            filters: {}
        }
    }, // data

    mounted() {
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
                child.$on('click', this.onFilterClick);
            }
        }
        this.initParams();
        this.getRows();
    }, // mounted

    methods: {
        async getRows() {
            this.loading = true;
            try {
                const url = this.getUrl(this.src);
                const resp = await axios.get(url);
                this.rows = resp.data.data;
                this.pagination = resp.data.meta;
            } catch (e) {
                console.log(e);
            }
            this.loading = false;
        },
        async onPage(page) {
            this.page = page;
            this.pushState();
            await this.getRows();
        },
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
        pushState() {
            const data = {
                page: this.page,
                sort: this.sort
            };
            const url = this.getUrl(window.location.href);
            window.history.pushState(data, '', url);            
        },
        initParams() {
            const url = new URL(window.location.href);
            const params = url.searchParams;
            if (params.has('page')) {
                this.page = params.get('page');
            }
            if (params.has('sort') && params.has('order')) {
                this.updateColumnOrder(params.get('sort'), params.get('order'));
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
        async onFilterClick(filter, value) {
            this.filters[filter] = value;
            this.pushState();
            await this.getRows();
        }
    } // methods
}
</script>