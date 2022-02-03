<template>


    <div class="row q-pa-md">
        <div class="col-12 col-md-12 row justify-end" >
           <q-btn v-if="$can('create airline')" color="primary" icon="add" rounded @click="onAdd">

           </q-btn>
        </div>
        <div v-if="$can('view airlines')" class="col-12 col-md-12 q-mt-md" >
            <q-table  :data="airports" :columns="columns">
                <template v-slot:body-cell-actions="props">
                    <q-btn v-if="$can('update airline')" color="primary" size="md" icon="edit" round flat  @click="onEdit(props.row)">
                        <q-tooltip content-class="bg-indigo" :offset="[10, 10]">
                            Editar
                        </q-tooltip>
                    </q-btn>
                    <q-btn v-if="$can('delete airline')" color="red" size="md" icon="delete" round flat  @click="onDelete(props.row)">
                        <q-tooltip content-class="bg-indigo" :offset="[10, 10]">
                            Eliminar
                        </q-tooltip>
                    </q-btn>
                    <q-btn color="primary" size="md" icon="description" round flat  @click="goToRemarks(props.row)">
                        <q-tooltip content-class="bg-indigo" :offset="[10, 10]">
                            Observaciones
                        </q-tooltip>
                    </q-btn>
                </template>
            </q-table>
        </div>

        <CreateEdit v-model="showForm" @onSave="onSave" :record="record" :is-edit="isEdit" @onCancel="onCancel"></CreateEdit>
    </div>
    

</template>

<script>
import { AirlinesService } from '../../services/airlines/AirlinesService';

const airlineService = new AirlinesService();

import columns from '../../config-tables/config-tables-airlines';
import CreateEdit from './CreateEdit.vue';

export default {
    name: 'AirportsIndex',
    components: { CreateEdit },
    created(){
        this.getAirlines();
    },
    data(){
        return {
            columns:columns,
            airports:[],
            showForm:false,
            record: null,
            isEdit:false,
        }
    },
    methods:{

        async getAirlines(){
            this.$q.loading.show();
            this.airports = await airlineService.get();
            this.$q.loading.hide();
        },
        onAdd(){
            this.showForm = true;
            this.isEdit = false;
        },
        onCancel(){
            this.record = null;
        },
        onEdit( airline ){
            this.record = airline;
            this.isEdit = true;
            this.showForm = true;
        },
        async onSave(airline){
            try {
                this.$q.loading.show();

                const response =  !this.isEdit ? await airlineService.insert(airline) : await airlineService.update(airline);

                if(!response.success) {
                    return this.$q.notify(response.msg,'error');
                }

                this.$notify(response.msg);
                this.showForm = false;
                this.getAirlines();
            } catch (error) {
                console.log(error);
               this.$notify('Lo sentimos ocurrio un error','error');
            }finally {
                this.$q.loading.hide();
            }

        },
        async onDelete(airline){
            const confirm = await this.$confirm('Eliminar',"¿Desea eliminar el registro?");

            if(!confirm) return;

            try {
                this.$q.loading.show();
                const response = await airlineService.delete(airline.id);

                if(!response.success) {
                    return this.$notify(response.msg,'error');
                }

                this.$notify(response.msg);
                this.getAirlines();
            } catch (error) {
               this.$notify('Lo sentimos ocurrio un error','error');
            }finally {
                this.$q.loading.hide();
            }

        },
        goToRemarks(airline){
            this.$router.push({ 
                name: 'remarks',
                params: {
                    id: airline.id,
                    type: 'airlines'
                }
            });
        }

    }


}
</script>
