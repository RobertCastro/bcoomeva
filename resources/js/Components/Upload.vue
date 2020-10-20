<template>
<input ref="csv" type="file" @change="onFileChange">
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
    }
  },
}
</script>