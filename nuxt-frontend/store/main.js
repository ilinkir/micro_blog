import isEmpty from 'lodash/isEmpty';
import api from "~/src/api/api";

export const state = () => ({
  users: [],
});
export const getters = {};
export const mutations = {
  setUsers(state, data) {
    state.users = data;
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
    return this.$axios(api.getUsers(route)).then((res) => {
      // if (res.data.error === 0) {}
      const content = res.data;

      if (!isEmpty(content.users)) {
        commit('setUsers', content.users);
      }
    })
  },
};
