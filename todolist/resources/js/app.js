import Vue from 'vue'

//Main pages
import App from './views/app.vue'
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
Vue.use(Vuetify)

const app = new Vue({
    vuetify: new Vuetify(),
    el: '#app',
    components: { App }
});
