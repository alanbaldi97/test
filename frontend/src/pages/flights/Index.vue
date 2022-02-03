<template>


    <div class="row q-pa-md">
        <div class="col-12 col-md-12 row justify-end" >
           <q-btn v-if="$can('create flight')" color="primary" icon="add" rounded @click="onAdd">

           </q-btn>
        </div>
        <div v-if="$can('view flights')" class="col-12 col-md-12 q-mt-md" >
            <q-table  :data="airports" :columns="columns">
                <template v-slot:body-cell-actions="props">
                    
                    <q-btn v-if="$can('update flight')" color="primary" size="md" icon="edit" round flat  @click="onEdit(props.row)">
                        <q-tooltip content-class="bg-indigo" :offset="[10, 10]">
                            Editar
                        </q-tooltip>
                    </q-btn>
                    <q-btn v-if="$can('delete flight')" color="red" size="md" icon="delete" round flat  @click="onDelete(props.row)">
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
import { FlightsService } from '../../services/flights/FlightsService';

const flightsService = new FlightsService();

import columns from '../../config-tables/config-tables-flights';
import CreateEdit from './CreateEdit.vue';

export default {
    name: 'AirportsIndex',
    components: { CreateEdit },
    created(){
        this.getFlights();
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

        async getFlights(){
            this.$q.loading.show();
            this.airports = await flightsService.get();
            this.$q.loading.hide();
        },
        onAdd(){
            this.showForm = true;
            this.isEdit = false;
        },
        onCancel(){
            this.record = null;
        },
        onEdit( flight ){
            this.record = flight;
            this.isEdit = true;
            this.showForm = true;
        },
        async onSave(flight){
            try {
                this.$q.loading.show();

                const response =  !this.isEdit ? await flightsService.insert(flight) : await flightsService.update(flight);

                if(!response.success) {
                    return this.$q.notify(response.msg,'error');
                }

                this.$notify(response.msg);
                this.showForm = false;
                this.getFlights();
            } catch (error) {
                console.log(error);
               this.$notify('Lo sentimos ocurrio un error','error');
            }finally {
                this.$q.loading.hide();
            }

        },
        async onDelete(flight){
            const confirm = await this.$confirm('Eliminar',"¿Desea eliminar el registro?");

            if(!confirm) return;

            try {
                this.$q.loading.show();
                const response = await flightsService.delete(flight.id);

                if(!response.success) {
                    return this.$notify(response.msg,'error');
                }

                this.$notify(response.msg);
                this.getFlights();
            } catch (error) {
               this.$notify('Lo sentimos ocurrio un error','error');
            }finally {
                this.$q.loading.hide();
            }



        },
        goToRemarks(flight){
            this.$router.push({ 
                name: 'remarks',
                params: {
                    id: flight.id,
                    type: 'flights'
                }
            });
        }

    }


}
</script>
