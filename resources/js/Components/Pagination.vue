<template>
<div class="mt-6 flex flex-wrap">
    <template v-for="(link, key) in links">
        <div v-if="!link.url" :key="key" class="mr-1 mb-1 px-4 py-3 text-sm border rounded text-gray-50">
            {{ link.label }}
        </div>
        <intertia-link 
            v-else
            :key="key"
            class="mr-1 mb-1 px-4 py-3 text-sm border rounded focus:border-indigo-500 focus:text-indigo-500"
            :class="{ 'bg-indigo-600 text-white': link.active }"
            :href="link.url"
        >
        {{ link.label }}

        </intertia-link>

    </template>

</div>
    
</template>

<script>
export default {
    name: "Pagination",
    props: {
        links: Array
    }
}
</script>