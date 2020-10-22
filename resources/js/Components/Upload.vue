<template>
<div>
<input ref="csv" class="hidden" type="file" @change="onFileChange">
<button class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 mt-5 px-4 rounded" type="button" @click.prevent="selectNewPhoto">
  <svg class="h-5 w-5 inline-block "  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
  </svg>
    Importar 
</button>
</div>

</template>

<script>
export default {
  data() {
    return {
      form: {
        csv: null,
      },
    }
  },
  methods: {

    onFileChange() {
        const files = this.$refs.csv.files;
        const data = new FormData();
        data.append('csv', files[0]);

        this.$inertia.post(this.route('dashboard.store'), data)
    },
    selectNewPhoto() {
        this.$refs.csv.click();
    },
  },
}
</script>