<template>
  <div>
  <input ref="csv" class="hidden" type="file" @change="onFileChange">
  <button class="bg-green-700 hover:bg-green-800 text-white font-bold py-3 mt-5 px-4 rounded flex items-center" type="button" @click.prevent="selectFile">
    <div v-if="loading" class="loading-upload mr-2" />
   
    <svg class="h-5 w-5 inline-block mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11l3-3m0 0l3 3m-3-3v8m0-13a9 9 0 110 18 9 9 0 010-18z" />
</svg>
      Importar Datos
  </button>
  </div>
</template>

<script>
import LoadingButton from "./LoadingButton";
export default {
  components: {
        LoadingButton
  },
  data() {
    return {
      loading: false,
      form: {
        csv: null,
      },
    }
  },
  methods: {

    onFileChange() {
      this.loading = true;
      const files = this.$refs.csv.files;
      const data = new FormData();
      data.append('csv', files[0]);

        this.$inertia.post(this.route('dashboard.store'), data)
        .then(() => this.loading = false);
    },
    selectFile() {
        this.$refs.csv.click();
    },
  },
}
</script>