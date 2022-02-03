<template>
    <q-dialog v-model="dialog" persistent @show="onShow" >
        <q-card style="width: 400px">
            <q-card-section>
                <div class="text-h6">{{ title }}</div>
            </q-card-section>
            <q-separator />
            <q-card-section>
                <q-form ref="form" @submit.prevent="">
                    <q-input v-model="airline.name" dense outlined :rules="rules" label="Nombre"></q-input>
                    <q-input dense v-model="airline.code" class="q-mt-md" outlined :rules="rules" label="Código"></q-input>
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
            airline: {
                name: null,
                code: null,
            },
            rules: [required]
        }
    },
    computed:{
        title(){
            return this.isEdit ? 'Editar Aerolinea' : 'Nueva Aerolinea'
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

            this.$emit('onSave',this.airline);
        },
        onShow(){
            if( this.record ){
                this.airline = { ...this.record }
            }else {
                this.airline = {
                    name: null,
                    code: null,
                }
            }

            this.$refs.form.reset();

        }
    }
}
</script>