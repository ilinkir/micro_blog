<template>
  <div>
    141
  </div>
</template>

<script>
export default {
  // layout: 'auth',
  middleware: 'auth',
  data() {
    return {
      form: {
        text: '',
        title: '',
        is_relevant: '',
      },
      error: null,
    }
  },
  fetch(){
    this.$axios.get('/api/post/').then(
      (res) => {
        console.log(res)
      }
    )
  }
}
</script>
