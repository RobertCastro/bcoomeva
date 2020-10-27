<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Asociados
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <div class="p-5 mb-6 flex flex-col md:flex-row md:justify-between items-center  ">
                       
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Busca número de cédula
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                v-model="form.search"
                                type="text"
                                placeholder="Escriba el número a buscar"
                            />
                        </div>

                        <upload />

                    </div>

                    <div class="bg-white rounded shadow overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <tr class="text-left font-bold">
                                <th class="px-6 pt-6 pb-4">Nombre</th>
                                <th class="px-6 pt-6 pb-4">Cédula</th>
                            </tr>
                            <affiliated
                                v-for="dato in datos.data"
                                :key="dato.id"
                                :dato="dato"
                            />
                        </table>
                    </div>
                </div>
                <pagination :links="datos.links" />
            </div>
        </div>
       
    </app-layout>
</template>

<script>
    import debounce from "lodash/debounce";
    import pickBy from "lodash/pickBy";
    import mapValues from "lodash/mapValues";
    import AppLayout from "../../Layouts/AppLayout";
    import Pagination from "../../Components/Pagination";
    import Upload from "../../Components/Upload";
    import Affiliated from "../../Components/Affiliated";

    export default {
        components: {Affiliated, AppLayout, Pagination, Upload},
        props: {
            datos: Object,
            filters: Object,
        },
        data() {
            return {
                processing: false,
                form: {
                    search: this.filters.search,
                    trashed: this.filters.trashed,
                }
            }
        },
        watch: {
            form: {
                handler: debounce(function() {
                    let query = pickBy(this.form)
                    this.$inertia.replace(this.route('dashboard.affiliated', query))
                }, 500),
                deep: true,
            }
        },
        methods: {
            reset() {
                this.form = mapValues(this.form, () => null);
            },
        }
    }
</script>
