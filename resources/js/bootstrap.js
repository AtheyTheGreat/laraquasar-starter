import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


window.axios.interceptors.response.use(response => {
    return response;
}, error => {
    if (error.response.status === 401) {
        window.location.href = '/login'
    }
    return Promise.reject(error);
});