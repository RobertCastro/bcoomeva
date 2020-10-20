<template>
    <form @submit.prevent="$emit('submit')" class="  px-8 pt-6 pb-8 mb-4" >
        <div class="mb-4">
            <text-input
                required="required"
                v-model="form.dni"
                :error="errors.dni"
                placeholder="Número de cédula"
            />
        </div>
        <div class="px-8 py-4 border-t border-gray-200 flex justify-center items-center">
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
