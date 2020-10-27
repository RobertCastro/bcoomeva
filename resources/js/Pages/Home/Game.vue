<template>
    <div>
        <div class="h-10 bg-green-700 text-center  pt-2 pb-6">
            <p class="text-cool-gray-50 font-bold inline-block"> Hola {{usuario.name}}</p>
            <button class="inline-block ml-15 bg-gray-100 py-0 px-3 rounded text-green-700 font-bold" v-on:click="reload">Nuevo Juego</button>
        </div>
        <div>
            <iframe style="height: 94vh" class="w-full " src="/BINGO_COOMEVA/index.html" frameborder="0"></iframe>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        usuario: Object,
    },
    methods: {
        reload: function (event) {
            location.reload();
        }
    }
}
</script>