import { createApp } from 'vue'
import App from './App.vue'
import './assets/tailwind.css'
import router from './router'
import axios from '@/axios-config'

axios.defaults.baseURL = 'http://localhost:8000/api/'
export const BASE_URL = 'http://localhost:8000/';

const app = createApp(App)

app.config.globalProperties.$baseUrl = BASE_URL
app.use(router).mount('#app')
