<template>


    <div class="row q-pa-md">
        <div class="col-12 col-md-12 row justify-between" >
           <q-btn color="secondary" icon="arrow_back" rounded @click="$router.back()">

           </q-btn>
           <q-btn color="primary" icon="add" rounded @click="onAdd">

           </q-btn>
        </div>
        <div class="col-12 col-md-12 q-mt-md" >
            <q-table :data="remarks" :columns="columns">
                <template v-slot:body-cell-actions="props">
                    <q-btn color="primary" size="md" icon="edit" round flat  @click="onEdit(props.row)"></q-btn>
                    <q-btn color="red" size="md" icon="delete" round flat  @click="onDelete(props.row)"></q-btn>
                </template>
            </q-table>
        </div>

        <CreateEdit v-model="showForm" @onSave="onSave" :record="record" :is-edit="isEdit" @onCancel="onCancel"></CreateEdit>
    </div>
    

</template>

<script>
import { RemarksService } from '../../services/remarks/RemarksService';

const remarksService = new RemarksService();

import columns from '../../config-tables/config-tables-remarks';
import CreateEdit from './CreateEdit.vue';

export default {
    name: 'RemarksIndex',
    components: { CreateEdit },
    created(){
        
        const { id, type } = this.$route.params;

        this.id = id;
        this.type = type;

        this.getRemarks();

    },
    data(){
        return {
            columns:columns,
            remarks:[],
            showForm:false,
            record: null,
            isEdit:false,
            id:null,
            type:null,
        }
    },
    methods:{

        async getRemarks(){
           
            this.$q.loading.show();
            this.remarks = await remarksService.get(this.id, this.type);
            this.$q.loading.hide();
        },
        onAdd(){
            this.showForm = true;
            this.isEdit = false;
        },
        onCancel(){
            this.record = null;
        },
        onEdit( remark ){
            this.record = remark;
            this.isEdit = true;
            this.showForm = true;
        },
        async onSave(remark){
            try {
                this.$q.loading.show();

                const response =  !this.isEdit ? await remarksService.insert(this.id,this.type, remark) : await remarksService.update(remark);

                if(!response.success) {
                    return this.$q.notify(response.msg,'error');
                }

                this.$notify(response.msg);
                this.showForm = false;
                this.getRemarks();
            } catch (error) {
                console.log(error);
               this.$notify('Lo sentimos ocurrio un error','error');
            }finally {
                this.$q.loading.hide();
            }

        },
        async onDelete(remark){
            const confirm = await this.$confirm('Eliminar',"¿Desea eliminar el registro?");

            if(!confirm) return;

            try {
                this.$q.loading.show();
                const response = await remarksService.delete(remark.id);

                if(!response.success) {
                    return this.$notify(response.msg,'error');
                }

                this.$notify(response.msg);
                this.getRemarks();
            } catch (error) {
               this.$notify('Lo sentimos ocurrio un error','error');
            }finally {
                this.$q.loading.hide();
            }



        }

    }


}
</script>
