<template>
    <form @submit.prevent="$emit('submit')" class=" flex justify-center flex-col m-auto  sm:w-screen md:w-1/2 px-8 pt-6 pb-8 mb-4" >
        <div class="mb-2">
            <input
                required="required"
                v-model="form.dni"
                :error="errors.dni"
                placeholder="Número de cédula"
                class="btn-home h-15 font-bold block w-full bg-white-200 text-green-700 border-2 border-green-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            >
        </div>
        <div class=" py-4 border-t border-gray-200 flex justify-center items-center">
            <slot name="buttons" />
        </div>
    </form>
</template>

<script>
    import TextInput from "../TextInput";
    import TextAreaInput from "../TextAreaInput";
    export default {
        name: "HomeForm",
        components: {
            TextInput
        },
        props: {
            errors: Object,
            form: Object,
        }
    }
</script>
