<template>
  <!--  <div class="min-h-screen flex items-center justify-center bg-gray-200">-->
  <!--    <div-->
  <!--      class="bg-white w-full max-w-sm rounded-lg shadow-md overflow-hidden mx-auto"-->
  <!--    >-->
  <!--      <div class="py-4 px-6">-->
  <!--        <nuxt-link-->
  <!--          to="/"-->
  <!--          class="flex title-font font-medium items-center justify-center text-gray-900 mb-4"-->
  <!--        >-->
  <!--          Домой-->
  <!--        </nuxt-link>-->

  <!--        <p class="text-xl text-gray-600 text-center">Sign in to your account</p>-->

  <!--        <form @submit.prevent="loginPassport">-->
  <!--          <div class="mt-4">-->
  <!--            <label-->
  <!--              class="block text-gray-600 text-sm font-medium mb-2"-->
  <!--              for="LoggingEmailAddress"-->
  <!--            >Email</label-->
  <!--            >-->
  <!--            <input-->
  <!--              id="LoggingEmailAddress"-->
  <!--              v-model="form.username"-->
  <!--              class="bg-white text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full focus:border-blue-500 focus:outline-none focus:shadow-outline"-->
  <!--              type="email"-->
  <!--            />-->
  <!--          </div>-->

  <!--          <div class="mt-4">-->
  <!--            <div class="flex justify-between">-->
  <!--              <label-->
  <!--                class="block text-gray-600 text-sm font-medium mb-2"-->
  <!--                for="loggingPassword"-->
  <!--              >Password</label-->
  <!--              >-->
  <!--              <nuxt-link-->
  <!--                to="/forgot-password"-->
  <!--                class="text-xs text-gray-500 hover:underline"-->
  <!--              >-->
  <!--                Forget Password?-->
  <!--              </nuxt-link>-->
  <!--            </div>-->

  <!--            <input-->
  <!--              id="loggingPassword"-->
  <!--              v-model="form.password"-->
  <!--              class="bg-white text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full focus:border-blue-500 focus:outline-none focus:shadow-outline"-->
  <!--              type="password"-->
  <!--            />-->
  <!--          </div>-->

  <!--          <div class="mt-3">-->
  <!--            <span-->
  <!--              v-if="error"-->
  <!--              class="inline-flex items-center font-semibold text-sm text-red-600"-->
  <!--            >-->
  <!--              <svg-->
  <!--                aria-hidden="true"-->
  <!--                class="fill-current mr-2"-->
  <!--                height="12"-->
  <!--                width="12"-->
  <!--                viewBox="0 0 16 16"-->
  <!--                xmlns="http://www.w3.org/2000/svg"-->
  <!--              >-->
  <!--                <path-->
  <!--                  d="M10.115 1.308l5.635 11.269A2.365 2.365 0 0 1 13.634 16H2.365A2.365 2.365 0 0 1 .25 12.577L5.884 1.308a2.365 2.365 0 0 1 4.231 0zM8 10.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM8 9c.552 0 1-.32 1-.714V4.714C9 4.32 8.552 4 8 4s-1 .32-1 .714v3.572C7 8.68 7.448 9 8 9z"-->
  <!--                  fill-rule="evenodd"-->
  <!--                ></path>-->
  <!--              </svg>-->
  <!--              {{ error }}-->
  <!--            </span>-->
  <!--          </div>-->

  <!--          <div class="mt-8">-->
  <!--            <button-->
  <!--              class="bg-blue-500 text-white font-bold py-2 px-4 w-full rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600"-->
  <!--            >-->
  <!--              Login-->
  <!--            </button>-->
  <!--          </div>-->
  <!--        </form>-->
  <!--      </div>-->

  <!--      <div-->
  <!--        class="flex items-center justify-center py-4 bg-gray-100 text-center"-->
  <!--      >-->
  <!--        <span class="text-gray-600 text-sm">Don't have an account? </span>-->

  <!--        <nuxt-link-->
  <!--          to="/register"-->
  <!--          class="text-blue-600 font-bold mx-2 text-sm hover:text-blue-500"-->
  <!--        >-->
  <!--          Sign up-->
  <!--        </nuxt-link>-->
  <!--      </div>-->
  <!--    </div>-->
  <!--  </div>-->
    <form @submit.prevent="loginPassport">
      <img class="mb-4" src="/favicon.ico" alt="" width="72" height="57">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

      <div class="form-floating">
        <input v-model="form.username" required id="floatingInput" type="email" class="form-control" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input v-model="form.password" required id="floatingPassword" type="password" class="form-control" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
      <div>
        {{ error }}
      </div>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me">
          Remember me
        </label>
      </div>
      <div class="mb-3">
        Не зарегестрированы?
        <nuxt-link to="/register">Регистрация</nuxt-link>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
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
        username: '',
        password: '',
      },
      error: null,
      passport_client_id: '',
    }
  },
  methods: {
    async loginPassport() {
      this.error = null
      await this.$auth
        .loginWith('laravelPassportPassword', {
          data: this.form,
        })
        .then((res) => this.$router.push('/profile'))
        .catch((e) => (this.error = e.response.data.errors ?? e.response.data))

      // await this.$axios
      //   .$post('/api/oauth/token', {
      //     ...this.form,
      //     grant_type: "password",
      //     client_id: '6',
      //     client_secret: 'EQKX3aqGh675Zlj4T1RkmUcPbQvt4kvOLCwjjSIk',
      //     scope: "*",
      //   })
      //   .then((res) => {
      //     console.log(res)
      //   })
      //   .catch((e) => (this.error = e.response.data.errors ?? e.response.data))
    },
  },
}
</script>
<style scoped>
html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
  text-align: center!important;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

</style>
