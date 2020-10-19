<template>
    <form
        @submit.prevent="$emit('submit')"
        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
    >
        <div class="mb-4">
            <text-input
                label="Nombre del proyecto"
                v-model="form.name"
                :error="errors.name"
            />
        </div>
        <div class="mb-6">
            <text-area-input
                label="Extracto"
                v-model="form.excerpt"
                :rows="3"
                :error="errors.excerpt"
            />
        </div>
        <div class="mb-6">
            <text-area-input
                label="Contenido"
                v-model="form.content"
                :rows="6"
                :error="errors.content"
            />
        </div>
        <div class="px-8 py-4 border-t border-gray-200 flex justify-center items-center">
            <slot name="buttons" />
        </div>
    </form>
</template>

<script>
    import TextInput from "./TextInput";
    import TextAreaInput from "./TextAreaInput";
    export default {
        name: "ProjectForm",
        components: {
            TextInput, TextAreaInput
        },
        props: {
            errors: Object,
            form: Object,
        }
    }
</script>
