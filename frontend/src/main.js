import Vue from 'vue'
import '@mdi/font/css/materialdesignicons.css'
import App from './App.vue'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import router from "./router"
import agregarFiltros from "./filters";

agregarFiltros(Vue);

Vue.use(Buefy);

Vue.config.productionTip = false

new Vue({
    render: h => h(App),
    router: router,
}).$mount('#app')
