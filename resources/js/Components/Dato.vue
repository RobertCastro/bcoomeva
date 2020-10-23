<template>
    <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
        <td class="border-t px-6 py-4 flex items-center focus:text-indigo-500">
            {{ dato.name }}
        </td>
        <td class="border-t">
            {{ dato.dni }}
        </td>
        <td class="border-t text-center md:text-left">
            {{ dato.number_table }}
        </td>
        <td class="border-t">
            {{ formattedDate }}
        </td>
        <!-- <td class="border-t w-px">
            <inertia-link
                class="px-4 flex items-center"
                :href="route('dashboard.edit', dato.id)"
            >
                <svg
                    class="block w-6 h-6 fill-gray-400"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <polygon points="12.95 10.707 13.657 10 8 4.343 6.586 5.757 10.828 10 6.586 14.243 8 15.657 12.95 10.707" />
                </svg>
            </inertia-link>
        </td> -->
    </tr>
</template>

<script>
    export default {
        name: "Dato",
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
