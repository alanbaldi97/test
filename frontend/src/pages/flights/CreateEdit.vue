<template>
    <q-dialog v-model="dialog" persistent @show="onShow" >
        <q-card style="width: 400px">
            <q-card-section>
                <div class="text-h6">{{ title }}</div>
            </q-card-section>
            <q-separator />
            <q-card-section>
                <q-form ref="form" @submit.prevent="">
                    <q-input dense v-model="flight.code" class="q-mt-md" outlined :rules="rules" label="Código"></q-input>
                    <q-select dense outlined class="q-mt-md" v-model="flight.type" :options="types" :rules="rules" label="Tipo" />
                    <q-select option-value="id" option-label="name" dense outlined class="q-mt-md" v-model="flight.departure_id" :rules="rules" :options="airports" label="Sálida" emit-value map-options />
                    <q-select option-value="id" option-label="name" dense outlined class="q-mt-md" v-model="flight.destination_id" :rules="rules" :options="airports" label="Destino" emit-value map-options />
                    <q-input type="time" dense v-model="flight.departure_time" class="q-mt-md" outlined :rules="rules" label="Hora de sálida"></q-input>
                    <q-input type="time" dense v-model="flight.arrival_time" class="q-mt-md" outlined :rules="rules" label="Hora de llegada"></q-input>
                    <q-select option-value="id" option-label="name" dense outlined class="q-mt-md" :rules="rules" v-model="flight.airline_id" :options="airlines" label="Aerolinea" emit-value map-options />


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

import { AirlinesService } from '../../services/airlines/AirlinesService';
import { required } from '../../common/rules';


import { AirportService } from '../../services/airport/AirportService';

const airportService = new AirportService();
const airlinesService = new AirlinesService();

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
            flight: {
                code: null,
                type: null,
                departure_id: null,
                destination_id: null,
                departure_time: null,
                arrival_time: null,
                airline_id: null,
            },
            types: [
                "PASSENGER", "FREIGHT"
            ],
            rules: [required],
            airports: [],
            airlines: []
        }
    },
    computed:{
        title(){
            return this.isEdit ? 'Editar Vuelo' : 'Nuevo Vuelo'
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

        async getAirlinesAndAirports(){
            this.$q.loading.show();
            this.airports = await airportService.get();
            this.airlines = await airlinesService.get();
            this.$q.loading.hide();

        },
        
        async save(){
            const valid = await this.$refs.form.validate();

            if(!valid) return;

            this.$emit('onSave',this.flight);
        },
        async onShow(){
            await this.getAirlinesAndAirports();
            if( this.record ){
                this.flight = { ...this.record }
            }else {
                this.flight = {
                    code: null,
                    type: null,
                    departure_id: null,
                    destination_id: null,
                    departure_time: null,
                    arrival_time: null,
                    airline_id: null,
                }
            }

            this.$refs.form.reset();

        }
    }
}
</script>