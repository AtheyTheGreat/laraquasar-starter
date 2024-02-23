import './bootstrap';

import { createApp } from "vue";
import router from "./router"
import { Quasar, Notify, LoadingBar } from 'quasar'
import { createPinia } from 'pinia'

// Import icon libraries
import '@quasar/extras/material-icons/material-icons.css'

// Import Quasar css
import 'quasar/src/css/index.sass'

import App from "./App.vue"

const app = createApp(App)

const pinia = createPinia()

app.use(Quasar, {
    plugins: {
        Notify,
        LoadingBar,
    }, // import Quasar plugins and add here
})


app.use(pinia)
app.use(router);

// Make JS-Share globally accessible

app.mount("#app")