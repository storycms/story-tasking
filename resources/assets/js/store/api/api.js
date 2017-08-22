import api from 'axios'

export default {
  request (method, url, data, succCb = null, errCb = null) {
    return api({
      method: method,
      url: '/tasking/api/' + url,
      data: data,
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
      }
    }).then(succCb).catch(errCb)
  },

  get (url, data = {}, succCb = null, errCb = null) {
    return this.request('GET', url, data, succCb, errCb)
  },

  post (url, data = {}, succCb = null, errCb = null) {
    return this.request('POST', url, data, succCb, errCb)
  },

  put (url, data = {}, succCb = null, errCb = null) {
    return this.request('PUT', url, data, succCb, errCb)
  },

  delete (url, data = {}, succCb = null, errCb = null) {
    return this.request('DELETE', url, data, succCb, errCb)
  }
}
