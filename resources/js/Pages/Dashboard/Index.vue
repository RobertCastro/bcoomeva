<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Datos
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <div class="p-5 mb-6 flex justify-between items-center">
                        <!-- <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Estados
                            </label>
                            <div class="relative">
                                <select
                                    v-model="form.trashed"
                                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                >
                                    <option value="with">Con borrados</option>
                                    <option value="only">Sólo borrados</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div> -->

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

                        <button
                            class="border border-gray-400 hover:border-red-600 text-gray-500 hover:bg-red-600 hover:text-white font-bold py-3 mt-5 px-4 rounded"
                            type="button"
                            @click="showModal = true"
                        >
                        <svg class="h-5 w-5 inline-block " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                            Borrar Datos
                        </button>

                        <!-- <button
                            class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-3 mt-5 px-4 rounded"
                            type="button"
                            @click="reset"
                        >
                            Restablecer filtros
                        </button> -->
                        <upload />

                        <a
                            class="bg-green-700 hover:bg-green-800 text-white font-bold py-3 mt-5 px-4 rounded"
                            href="/dashboard/export"
                            target="blank_"
                        >
                        <svg class="h-5 w-5 inline-block " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                            <span>Descargar</span>
                            <span class="hidden md:inline">Datos</span>
                        </a>
                    </div>

                    <div class="bg-white rounded shadow overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <tr class="text-left font-bold">
                                <th class="px-6 pt-6 pb-4">Nombre</th>
                                <th class="px-6 pt-6 pb-4">Cédula</th>
                                <th class="px-6 pt-6 pb-4">Número Tabla</th>
                                <th class="px-6 pt-6 pb-4">Fecha</th>
                            </tr>
                            <dato
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
        <jet-confirmation-modal :show="showModal" @close="showModal = false">
            <template #title>
                Borrar datos
            </template>

            <template #content>
                ¿Estás seguro que quieres borrar los datos?
            </template>

            <template #footer>
                <jet-secondary-button @click.native="showModal = false">
                    Cancelar
                </jet-secondary-button>

                <jet-danger-button @click.native="destroy" class="ml-2" :class="{ 'opacity-25': processing }" :disabled="processing">
                    Borrar datos
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>
    </app-layout>
</template>

<script>
    import debounce from "lodash/debounce";
    import pickBy from "lodash/pickBy";
    import mapValues from "lodash/mapValues";
    import AppLayout from "../../Layouts/AppLayout";
    import Pagination from "../../Components/Pagination";
    import Upload from "../../Components/Upload";
    import Dato from "../../Components/Dato";
    import JetConfirmationModal from "../../Jetstream/ConfirmationModal";
    import JetSecondaryButton from "../../Jetstream/SecondaryButton";
    import JetDangerButton from "../../Jetstream/DangerButton";
    export default {
        components: {Dato, AppLayout, Pagination, Upload, JetConfirmationModal, JetSecondaryButton, JetDangerButton},
        props: {
            datos: Object,
            filters: Object,
        },
        data() {
            return {
                processing: false,
                showModal: false,
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
                    this.$inertia.replace(this.route('dashboard.index', query))
                }, 500),
                deep: true,
            }
        },
        methods: {
            reset() {
                this.form = mapValues(this.form, () => null);
            },
            destroy() {
                this.processing = true
                this.$inertia.delete(this.route('dashboard.destroy', 1))
                    .then(() => this.processing = false)
            }
        }
    }
</script>
