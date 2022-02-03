import Vue from 'vue'
import VueRouter from 'vue-router'

import routes from './routes'

Vue.use(VueRouter)

import { AuthService } from '../services/auth/AuthService';

const authService = new AuthService();

/*
 * If not building with SSR mode, you can
 * directly export the Router instantiation;
 *
 * The function below can be async too; either use
 * async/await or return a Promise which resolves
 * with the Router instance.
 */

export default function (/* { store, ssrContext } */) {
  const Router = new VueRouter({
    scrollBehavior: () => ({ x: 0, y: 0 }),
    routes,

    // Leave these as they are and change in quasar.conf.js instead!
    // quasar.conf.js -> build -> vueRouterMode
    // quasar.conf.js -> build -> publicPath
    mode: process.env.VUE_ROUTER_MODE,
    base: process.env.VUE_ROUTER_BASE
  });

  

  Router.beforeEach( async function(to, from , next){ 

    console.log(to.name);

    if(to.name == 'error') return next();

    

    const { auth } = await authService.autenticate();

    if(!to.meta.auth){
      if(to.name == 'login' && !auth){
        return next();
      }

      return next({name: 'welcome'})
     
    }


    if( auth ) {
      if(to.name == 'welcome' || to.name == 'remarks'){
        next()
      }else if(!authService.can(to.meta.permission)){
        return next({name: 'errorForbidden'});
      } 
      return next()
    } 
    else return next({ name: 'login' })

   
  });




  return Router
}
