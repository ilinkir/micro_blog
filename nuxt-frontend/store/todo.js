export const state = () => ({
  comments: []
});
export const getters = {
  getAllComments(state){
    return state.comments;
  }
};
export const mutations = {
  setComments(state, comments){
    state.comments = comments;
  },
  createComment(state, comment){
    state.comments.unshift(comment)
  }
};
export const actions = {
  fetchComments({commit}, limit = 5){
    return fetch('https://jsonplaceholder.typicode.com/comments?_limit=' + limit)
      .then(response => response.json())
      .then(json => {
        commit("setComments", json)
        // this.comments = json;
        // this.loading = false;
      })
  }
};
