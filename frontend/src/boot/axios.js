import Vue from 'vue'
import axios from 'axios'

Vue.prototype.$axios = axios


export const api = axios.create({
    baseURL: 'http://3hbs_test.test/api/'
});
