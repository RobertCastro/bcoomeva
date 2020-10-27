<template>
    <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
        <td class="border-t px-6 py-4 flex items-center focus:text-indigo-500">
            {{ dato.name }}
        </td>
        <td class="border-t">
            {{ dato.dni }}
        </td>
    </tr>
</template>

<script>
    export default {
        name: "Affiliated",
        props: {
            dato: Object,
        },

        computed: {
            formattedDate() {
                return moment(this.dato.updated_at).format('lll');
            }
        },
    }
</script>
