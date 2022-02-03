<template>
    <q-dialog v-model="dialog" persistent @show="onShow" >
        <q-card style="width: 300px">
            <q-card-section>
                <div class="text-h6">{{ title }}</div>
            </q-card-section>
            <q-separator />
            <q-card-section>
                <q-form ref="form" @submit.prevent="">
                    <q-input v-model="remark.description" dense outlined :rules="rules" label="Observación"></q-input>
                    <!-- <q-input dense v-model="airline.code" class="q-mt-md" outlined :rules="rules" label="Código"></q-input> -->
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
            remark: {
                description: null,
            },
            rules: [required]
        }
    },
    computed:{
        title(){
            return this.isEdit ? 'Editar Observación' : 'Nueva Observación'
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

            this.$emit('onSave',this.remark);
        },
        onShow(){
            if( this.record ){
                this.remark = { ...this.record }
            }else {
                this.remark = {
                    description: null,
                }
            }

            this.$refs.form.reset();

        }
    }
}
</script>