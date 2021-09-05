<template>
  <div>
    <div v-for="(user,idx) in users" :key="idx">
      {{ user.name }}
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import fetchSilence from '@/src/tools/safeRequest';

export default {
  fetch({ store, error, route }) {
    return fetchSilence(store, error, 'main/loadPage', route);
  },
  computed: {
    ...mapState('main', ['users']),
  },
}
</script>
