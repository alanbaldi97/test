<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar >
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"
        />

        <q-toolbar-title>
          <!-- Quasar App -->
        </q-toolbar-title>

        <div> 
          <q-btn-dropdown flat color="white" :label="`${ user.name } ( ${ roles.join(',') } ) `">
            <q-list>
              <q-item clickable v-close-popup @click="logOut">
                <q-item-section>
                  <q-item-label>Cerrar Sesión</q-item-label>
                </q-item-section>
              </q-item>
            </q-list>
          </q-btn-dropdown>
          
        </div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      content-class="bg-grey-1"
    >
      <q-list>
        <q-item-label
          header
          class="text-grey-8"
        >
          Menu
        </q-item-label>
        <template v-for="link in essentialLinks">
          <EssentialLink
            v-if="$can(link.permission)"  
            :key="link.title"
            v-bind="link"
          />
        </template>
        
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import EssentialLink from 'components/EssentialLink.vue'
import { mapGetters } from 'vuex'

import { AuthService } from '../services/auth/AuthService';

const authService = new AuthService()
const linksList = [
  {
    title: "Aeropuertos",
    icon: "apartment",
    routeName: 'airports',
    permission: 'view airports'
  },
  {
    title: "Aerolineas",
    icon: "flight_takeoff",
    routeName: 'airlines',
    permission: 'view airlines'
  },
  {
    title: "Vuelos",
    icon: "flight",
    routeName: 'flights',
    permission: 'view flights'
  },
 
];

export default {
  name: 'MainLayout',
  components: { EssentialLink },
  data () {
    return {
      leftDrawerOpen: false,
      essentialLinks: linksList
    }
  },
  computed: {

    ...mapGetters('auth',{
      user: 'getUser',
      roles: 'getRoles'
    })

  },
  methods:{

    async logOut(){
      try{

        this.$q.loading.show();

        const response = await authService.logOut();

        if(!response.success) {
          return this.$notify(response.msg,'error');
        }

        this.$router.push('/');
        this.$q.loading.hide();
        // this.$notify(response.msg);

      }catch(error){
        this.$notify('Lo sentimos ocurrio un error al cerrar la sesión','error');
      }
    }

  }
}
</script>
