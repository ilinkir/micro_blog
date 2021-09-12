<template>
<!--  <div class="min-h-screen bg-gray-200 pt-20">-->
<!--    <div-->
<!--      class="flex max-w-sm mx-auto bg-white rounded-lg shadow-lg overflow-hidden lg:max-w-4xl"-->
<!--    >-->
<!--      <div class="w-full py-8 px-6 md:px-8 lg:w-1/2">-->

<!--        <p class="text-xl text-gray-600 text-center">Create your account</p>-->

<!--        <form @submit.prevent="register">-->
<!--          <div class="mt-4">-->
<!--            <label-->
<!--              class="block text-gray-600 text-sm font-medium mb-2"-->
<!--              for="RegisterName"-->
<!--            >Name</label-->
<!--            >-->
<!--            <input-->
<!--              id="RegisterName"-->
<!--              v-model="form.name"-->
<!--              class="bg-white text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full focus:border-blue-500 focus:outline-none focus:shadow-outline"-->
<!--              type="text"-->
<!--            />-->

<!--            <span v-if="error && error.name" class="text-xs text-red-600">-->
<!--              {{ error.name[0] }}-->
<!--            </span>-->
<!--          </div>-->

<!--          <div class="mt-4">-->
<!--            <label-->
<!--              class="block text-gray-600 text-sm font-medium mb-2"-->
<!--              for="RegisterEmail"-->
<!--            >Email</label-->
<!--            >-->
<!--            <input-->
<!--              id="RegisterEmail"-->
<!--              v-model="form.email"-->
<!--              class="bg-white text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full focus:border-blue-500 focus:outline-none focus:shadow-outline"-->
<!--              type="email"-->
<!--            />-->

<!--            <span v-if="error && error.email" class="text-xs text-red-600">-->
<!--              {{ error.email[0] }}-->
<!--            </span>-->
<!--          </div>-->

<!--          <div class="mt-4">-->
<!--            <label-->
<!--              class="block text-gray-600 text-sm font-medium mb-2"-->
<!--              for="RegisterPassword"-->
<!--            >Password</label-->
<!--            >-->

<!--            <input-->
<!--              id="RegisterPassword"-->
<!--              v-model="form.password"-->
<!--              class="bg-white text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full focus:border-blue-500 focus:outline-none focus:shadow-outline"-->
<!--              type="password"-->
<!--            />-->

<!--            <span v-if="error && error.password" class="text-xs text-red-600">-->
<!--              {{ error.password[0] }}-->
<!--            </span>-->
<!--          </div>-->

<!--          <div class="mt-8">-->
<!--            <button-->
<!--              class="bg-blue-500 text-white font-bold py-2 px-4 w-full rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600"-->
<!--            >-->
<!--              Create account-->
<!--            </button>-->
<!--          </div>-->
<!--        </form>-->

<!--        <div class="mt-4 flex items-center justify-between">-->
<!--          <span class="border-b w-1/5 md:w-1/4"></span>-->

<!--          <nuxt-link-->
<!--            to="/login"-->
<!--            class="text-xs text-gray-500 uppercase hover:underline"-->
<!--          >-->
<!--            or sign in-->
<!--          </nuxt-link>-->

<!--          <span class="border-b w-1/5 md:w-1/4"></span>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->

  <form @submit.prevent="register">
    <img class="mb-4" src="/favicon.ico" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Регистрация</h1>

    <div class="form-floating">
      <input v-model="form.name" required id="floatingInput" type="text" class="form-control" placeholder="Name">
      <label for="floatingInput">Name</label>
    </div>
    <div class="form-floating">
      <input v-model="form.email" required id="floatingEmail" type="email" class="form-control" placeholder="name@example.com">
      <label for="floatingEmail">Email address</label>
    </div>
    <div class="form-floating">
      <input v-model="form.password" required id="floatingPassword" type="password" class="form-control" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <div>
      {{ error }}
    </div>
    <div class="mb-3">
      Уже зарегестрированы?
      <nuxt-link to="/login">Войти</nuxt-link>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
    <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
  </form>
</template>

<script>
export default {
  layout: 'auth',
  auth: 'guest',
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
      },
      error: null,
    }
  },
  methods: {
    async register() {
      this.error = null
      await this.$axios
        .$post('/api/user/register/', {
          ...this.form,
          password_confirmation: this.form.password,
        })
        .then(() => {
          this.$router.push('/login')
        })
        .catch((e) => (this.error = e.response.data.errors ?? e.response.data))
    },
  },
}
</script>
