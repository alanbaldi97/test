<template>


    <div class="row q-pa-md">
        <div class="col-12 col-md-12 row justify-end" >
           <q-btn v-if="$can('create airport')" color="primary" icon="add" rounded @click="onAdd">

           </q-btn>
        </div>
        <div v-if="$can('view airports')" class="col-12 col-md-12 q-mt-md" >
            <q-table  :data="airports" :columns="columns">
                <template v-slot:body-cell-actions="props">
                    <q-btn v-if="$can('update airport')" color="primary" size="md" icon="edit" round flat  @click="onEdit(props.row)"></q-btn>
                    <q-btn v-if="$can('delete airport')" color="red" size="md" icon="delete" round flat  @click="onDelete(props.row)"></q-btn>
                    <q-btn color="primary" size="md" icon="description" round flat  @click="goToRemarks(props.row)"></q-btn>
                </template>
            </q-table>
        </div>

        <CreateEdit v-model="showForm" @onSave="onSave" :record="record" :is-edit="isEdit" @onCancel="onCancel"></CreateEdit>
    </div>
    

</template>

<script>
import { AirportService } from '../../services/airport/AirportService';

const airportService = new AirportService();

import columns from '../../config-tables/config-tables-airports';
import CreateEdit from './CreateEdit.vue';

export default {
    name: 'AirportsIndex',
    components: { CreateEdit },
    created(){
        this.getAirports();
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

        async getAirports(){
            this.$q.loading.show();
            this.airports = await airportService.get();
            this.$q.loading.hide();
        },
        onAdd(){
            this.showForm = true;
            this.isEdit = false;
        },
        onCancel(){
            this.record = null;
        },
        onEdit( airport ){
            this.record = airport;
            this.isEdit = true;
            this.showForm = true;
        },
        async onSave(airport){
            try {
                this.$q.loading.show();

                const response =  !this.isEdit ? await airportService.insert(airport) : await airportService.update(airport);

                if(!response.success) {
                    return this.$q.notify(response.msg,'error');
                }

                this.$notify(response.msg);
                this.showForm = false;
                this.getAirports();
            } catch (error) {
                console.log(error);
               this.$notify('Lo sentimos ocurrio un error','error');
            }finally {
                this.$q.loading.hide();
            }

        },
        async onDelete(airport){
            const confirm = await this.$confirm('Eliminar',"¿Desea eliminar el registro?");

            if(!confirm) return;

            try {
                this.$q.loading.show();
                const response = await airportService.delete(airport.id);

                if(!response.success) {
                    return this.$notify(response.msg,'error');
                }

                this.$notify(response.msg);
                this.getAirports();
            } catch (error) {
               this.$notify('Lo sentimos ocurrio un error','error');
            }finally {
                this.$q.loading.hide();
            }

        },
        goToRemarks(airport){
            this.$router.push({ 
                name: 'remarks',
                params: {
                    id: airport.id,
                    type: 'airports'
                }
            });
        }

    }


}
</script>
