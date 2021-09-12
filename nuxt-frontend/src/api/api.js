class Api {
  getUsers(route) {
    return this.get('/api/users', {}, {path: route.path});
  }

  getPosts(route) {
    return this.get('/api/posts/my', {}, {path: route.path});
  }

  get(path, data = {}, headers = {}, credentials = false) {
    return {
      url: path,
      params: data,
      headers,
      withCredentials: credentials,
    };
  }

  post(path, data = {}, headers = {}, credentials = false) {
    return {
      url: path,
      method: 'post',
      data,
      headers,
      withCredentials: credentials,
    };
  }
}

const api = new Api();

export default api;
