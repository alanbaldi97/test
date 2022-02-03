<template>
    <q-layout >
        <q-page-container class="q-mt-md" >
            <div class="row justify-center">
                <div class="col-6 col-md-6">
                    <q-card class="col-2 col-md-2">
                        <img src="https://www.eleconomista.com.mx/__export/1559878811565/sites/eleconomista/img/2019/02/20/aeropuerto_cuernavaca.jpg_423392900.jpg" width="50%" alt="">
                        <q-separator />
                        <q-card-section>
                            <q-form ref="form" @submit.prevent="login">
                                <q-input dense outlined v-model="email" :rules="rules" label="Correo"></q-input>
                                <q-input dense type="password" outlined v-model="password" :rules="rules" label="Contraseña" @keypress.enter="login"></q-input>
                                <q-btn class="full-width" color="secondary" rounded label="Iniciar Sesión"  @click="login" />
                            </q-form>
                        </q-card-section>
                    </q-card>
                </div>
                
            </div>
            
        </q-page-container>
    </q-layout>
    
</template>
<script>
import { mapActions } from 'vuex';
import { required } from '../common/rules';
import { AuthService } from '../services/auth/AuthService';

const authService = new AuthService();

export default {
    name:'Login',
    data(){
        return {
            email:null,
            password: null,
            rules:[required]
        }
    },
    methods:{

        ...mapActions('auth',['setUser']),


        async login(){

            try {
                this.$q.loading.show();
                const valid = await this.$refs.form.validate();
                if(!valid) return;


                const response = await authService.login(this.email, this.password);
                if(!response.success) return this.$notify(response.msg,'error');

                const { user, access_token } = response;

                localStorage.setItem('token',access_token);
                this.setUser(user);

                this.$router.push({name: 'inicio'});
                
            } catch (error) {
                console.log(error);
                this.$notify('Lo sentimos ocurrio un error','error');
            }finally {
                this.$q.loading.hide();
            }
            
        }
    }
}
</script>