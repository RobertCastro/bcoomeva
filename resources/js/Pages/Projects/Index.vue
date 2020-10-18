<template>
<app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> 
            Listado de proyectos con Inertia
        </h2>
    </template>
    <pagination :links="projects.links" />
</app-layout>
    
</template>

<script>

    import debounce  from "lodash/debounce";
    import pickBy from "lodash/pickBy";
    import mapValues from "lodash/mapValues";
    import AppLayout from "../../Layouts/AppLayout";
    import Pagination from "../../Components/Pagination";
    export default {
        components: {AppLayout, Pagination},
        props: {
            projects: Object,
            filters: Object
        },
        data() {
            return {
                form: {
                    search: this.filters.search,
                    trashed: this.filters.trashed
                }
            }
        },
        watch: {
            form: {
                handler: debounce( function() {
                    let query = pickBy(this.form)
                    this.$inertia.replace(this.route('projects.index', query))
                }, 500),
                deep: true
            }
        },
        methods: {
            reset() {
                this.form = mapValues(this.form, () => null);
            }
            
        }
    }
</script>