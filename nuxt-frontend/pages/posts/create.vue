<template>
  <form @submit.prevent="createPost">
    <img class="mb-4" src="/favicon.ico" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Создание Новости</h1>

    <div class="form-floating">
      <input v-model="form.title" required id="floatingInput" type="text" class="form-control" placeholder="name@example.com">
      <label for="floatingInput">Title</label>
    </div>
    <div class="form-floating">
      <input v-model="form.text" required id="floatingPassword" type="text" class="form-control" placeholder="Password">
      <label for="floatingPassword">Text</label>
    </div>
    <div>
      {{ error }}
    </div>
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me" v-model="form.is_relevant">
        Показать всем
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Создать</button>
    <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
  </form>
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
        is_relevant: 'true',
      },
      error: null,
    }
  },
  methods: {
    async createPost() {
      this.error = null
      await this.$axios
        .$post('/api/post/', {
          ...this.form,
        })
        .then((res) => {
          console.log(res);
        })
        .catch((e) => (this.error = e.response.data.errors ?? e.response.data))
    },
  },
}
</script>
