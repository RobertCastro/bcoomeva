<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Informe
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

                        <button
                            class="sm:w-full md:w-auto border border-gray-400 hover:border-red-600 text-gray-500 hover:bg-red-600 hover:text-white font-bold py-3 mt-5 px-4 rounded"
                            type="button"
                            @click="showModal = true"
                        >
                        <svg class="h-5 w-5 inline-block " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                            Borrar Datos
                        </button>

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

                    <div class="bg-white rounded shadow overflow-x-auto" v-if="datos.data != ''">
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
                    
                    <div v-if="datos.data == ''" class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md" role="alert">
                    <div class="flex">
                        <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                        <div>
                        <p class="font-bold">No hay datos</p>
                        </div>
                    </div>
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
                    .then(() => {
                        this.processing = false;
                        this.showModal = false;
                    })
            }
        }
    }
</script>
