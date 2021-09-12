<template>
  <div>
        <div v-for="(post,idx) in posts" :key="idx">
          <div>{{ post.title }}</div>
          <div>{{ post.text }}</div>
        </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import fetchSilence from "@/src/tools/safeRequest";

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
  fetch({ store, error, route }) {
    return fetchSilence(store, error, 'posts/loadPage', route);
  },
  computed:{
    ...mapState('posts', ['posts']),
  },
}
</script>
