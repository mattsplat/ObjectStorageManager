import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import {registerComponents} from './components';

import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";


const app = createApp({});
registerComponents(app);
app.use(Toast, {});

app.mount('#app');
