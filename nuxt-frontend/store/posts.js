import isEmpty from 'lodash/isEmpty';
import api from "~/src/api/api";

export const state = () => ({
  posts: [],
});
export const getters = {};
export const mutations = {
  setPosts(state, data) {
    state.posts = data;
  },
};
export const actions = {
  loadPage({commit}, route) {
    // return this.$axios.get('/api/users').then((res) => {
    //     const content = res.data;
    //
    //     if (!isEmpty(content.users)) {
    //       commit('setUsers', content.users);
    //     }
    // });
    return this.$axios(api.getPosts(route)).then((res) => {
      const content = res.data;
      if (!isEmpty(content.data.posts)) {
        commit('setPosts', content.data.posts);
      }
    })
  },
};
