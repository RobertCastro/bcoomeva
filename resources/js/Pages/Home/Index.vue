<template>
    <home-layout>
        <div class="relative flex items-top justify-center min-h-screen sm:items-center sm:pt-0">
            <div class="w-full max-w-6xl mx-auto sm:px-6 lg:px-8">
                <!-- <div class="flex justify-center pt-8 sm:justify-start sm:pt-0 text-center">
                    <div class="w-full" v-if="user">
                        <p class="text-green-700 font-bold">Hola {{ user.name }}!</p>
                    </div>
                </div> -->
                <div class="w-full flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <div class="w-full">
                        <jet-application-mark class="block h-20 w-full mb-8" />
                    </div>
                </div>
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0 text-center">
                    <div class="w-full" v-if="msg">
                        <p class="text-red-500 font-bold">{{ msg }}</p>
                    </div>
                </div>
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0 ">
                    <home-form :errors="errors" :form="form" @submit="submit">
                        <template #buttons>
                            <loading-button
                                :loading="processing"
                                class="justify-center uppercase text-justify bg-green-700 hover:bg-green-800 w-full text-white font-bold py-2 px-4 border-b-4 border-green-800 hover:border-green-900 rounded"
                                type="submit"
                            >
                                Buscar
                            </loading-button>
                        </template>
                    </home-form>
                </div>
            </div>
        </div>
    </home-layout>
</template>

<script>
    
    import HomeLayout from "../../Layouts/HomeLayout";
    import HomeForm from "../../Components/Home/HomeForm";
    import LoadingButton from "../../Components/LoadingButton";
    import JetApplicationMark from './../../Jetstream/ApplicationMark'

    export default {
    
        components: {
        HomeLayout, HomeForm, LoadingButton, JetApplicationMark
        },
        props: {
                errors: Object,
                user: Object,
                msg: String
            },

        data() {
                
            return {
                processing: false,
                form: {
                    dni: null,
                   
                }
            }
        },

        methods: {
            submit() {
                this.processing = true;
                this.$inertia.post(this.route('home.store'), this.form)
                    .then(() => {
                        this.processing = false,
                        localStorage.setItem('dni', this.form.dni);
                    });
            }
        }
        
    }
</script>