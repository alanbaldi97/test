import { api } from "src/boot/axios";


export class RemarksService{

    async get(id, type){
        
        const token = localStorage.getItem('token');
        
        try{

            const { data } = await api.get(`remarks/${id}/${type}`,{
                headers: {
                    Accept: 'application/json',
                    Authorization: `Bearer ${token}`
                }
            });

           return data;

        }catch(error){
            return [];
        }
        
    }

    async insert(id, type, payload){
        
        const token = localStorage.getItem('token');
        api.defaults.headers['Accept'] = 'application/json';
        api.defaults.headers['Authorization'] = `Bearer ${token}`;

        const { data } = await api.post(`remarks/${id}/${type}`,payload);    

        return data;
        
    }

    async update(payload){
        
        const token = localStorage.getItem('token');
        api.defaults.headers['Accept'] = 'application/json';
        api.defaults.headers['Authorization'] = `Bearer ${token}`;

        const { data } = await api.put(`remarks/${payload.id}`,payload);    

        return data;
        
    }

    async delete(payload){
        
        const token = localStorage.getItem('token');
        api.defaults.headers['Accept'] = 'application/json';
        api.defaults.headers['Authorization'] = `Bearer ${token}`;

        const { data } = await api.delete(`remarks/${payload}`);    

        return data;
        
    }

    

}
