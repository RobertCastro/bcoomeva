<template>
  <p>Desde layout home</p>
</template>

<script>
  export default {
    name: "Layout",
    props: {
      title: String,
    },
    watch: {
      title: {
        immediate: true,
        handler(title) {
          document.title = title
        },
      },
    },
  }
</script>