<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edita el proyecto {{ project.name }} 
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <project-form :errors="errors" :form="form" @submit="submit">
                    <template #buttons>
                        <button
                            class="text-red-600 hover:underline"
                            type="button"
                            @click="showModal = true"
                        >
                            Eliminar proyecto
                        </button>
                        <loading-button
                            :loading="processing"
                            class="ml-5 btn-indigo"
                            type="submit"
                        >
                            Editar proyecto
                        </loading-button>
                    </template>
                </project-form>
            </div>
        </div>

        <jet-confirmation-modal :show="showModal" @close="showModal = false">
            <template #title>
                Eliminar proyecto
            </template>

            <template #content>
                ¿Estás seguro que quieres eliminar el proyecto?
            </template>

            <template #footer>
                <jet-secondary-button @click.native="showModal = false">
                    Cancelar
                </jet-secondary-button>

                <jet-danger-button @click.native="destroy" class="ml-2" :class="{ 'opacity-25': processing }" :disabled="processing">
                    Eliminar proyecto
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>
    </app-layout>
</template>

<script>
    import AppLayout from "../../Layouts/AppLayout";
    import ProjectForm from "../../Components/ProjectForm";
    import LoadingButton from "../../Components/LoadingButton";
    import JetConfirmationModal from "../../Jetstream/ConfirmationModal";
    import JetSecondaryButton from "../../Jetstream/SecondaryButton";
    import JetDangerButton from "../../Jetstream/DangerButton";
    export default {
        components: {
            LoadingButton, ProjectForm, AppLayout,
            JetConfirmationModal, JetDangerButton, JetSecondaryButton
        },
        props: {
            project: Object,
            errors: Object,
        },
        data() {
            return {
                processing: false,
                showModal: false,
                form: {
                    name: this.project.name,
                    excerpt: this.project.excerpt,
                    content: this.project.content,
                }
            }
        },
        methods: {
            submit() {
                this.processing = true
                this.$inertia.put(this.route('projects.update', this.project.id), this.form)
                    .then(() => this.processing = false)
            },
            destroy() {
                this.processing = true
                this.$inertia.delete(this.route('projects.destroy', this.project.id))
                    .then(() => this.processing = false)
            }
        }
    }
</script>
