import './bootstrap';
import App from './App.vue'
import { createApp } from 'vue';

const app = createApp({});

app.component('app', App);

app.mount("#app");