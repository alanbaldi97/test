<template>
    <q-dialog v-model="dialog" persistent @show="onShow" >
        <q-card style="width: 400px">
            <q-card-section>
                <div class="text-h6">{{ title }}</div>
            </q-card-section>
            <q-separator />
            <q-card-section>
                <q-form ref="form" @submit.prevent="">
                    <q-input v-model="airport.name" dense outlined :rules="rules" label="Nombre"></q-input>
                    <q-input dense v-model="airport.code" class="q-mt-md" outlined :rules="rules" label="Código"></q-input>
                    <q-input dense v-model="airport.city" class="q-mt-md" outlined :rules="rules" label="Ciudad"></q-input>
                </q-form>
            </q-card-section>
            <q-card-section class="row justify-center">
                <q-btn color="red" rounded label="Cancelar" @click="dialog = false" />
                <q-btn class="q-ml-md" color="secondary" rounded :label=" !isEdit ?  'Registrar' : 'Actualizar'"  @click="save" />
            </q-card-section>
        </q-card>
    </q-dialog>
    
</template>

<script>


import { required } from '../../common/rules';

export default {
    name:'CreateEdit',
    props:{
        isEdit: {
            type: Boolean,
            default: false,
        },
        value:{
            type: Boolean,
            default: false,
        },
        record:{
            type: null,
            default: () => null,
        }
    },
    data(){
        return {
            airport: {
                name: null,
                code: null,
                city: null,
            },
            rules: [required]
        }
    },
    computed:{
        title(){
            return this.isEdit ? 'Editar Aeropuerto' : 'Nuevo Aeropuerto'
        },
        dialog: {
            get(){
                return this.value
            },
            set(val) {
                if(!val) this.$emit('onCancel');
                
                this.$emit('input',val)
            }
        }
    },
    methods: {
        async save(){
            const valid = await this.$refs.form.validate();

            if(!valid) return;

            this.$emit('onSave',this.airport);
        },
        onShow(){
            if( this.record ){
                this.airport = { ...this.record }
            }else {
                this.airport = {
                    name: null,
                    code: null,
                    city: null,
                }
            }

            this.$refs.form.reset();

        }
    }
}
</script>