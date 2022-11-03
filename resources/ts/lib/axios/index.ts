import axios from 'axios'
import useAxiosLogger from './axios-logger'

axios.defaults.baseURL = import.meta.env.VITE_LARAVEL_APP_URL
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.withCredentials = true

useAxiosLogger(axios)

export default axios
