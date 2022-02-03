import { Store } from 'src/store'
import Vue from 'vue'

const can = (name) => {
    let permissions = Store.getters['auth/permissions'];
    return permissions.indexOf(name) !== -1;

}

Vue.prototype.$can = can;