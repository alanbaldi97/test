import { api } from "src/boot/axios";


export class FlightsService{

    async get(){
        
        const token = localStorage.getItem('token');
        
        try{

            const { data } = await api.get(`flights`,{
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

    async insert(payload){
        
        const token = localStorage.getItem('token');
        api.defaults.headers['Accept'] = 'application/json';
        api.defaults.headers['Authorization'] = `Bearer ${token}`;

        const { data } = await api.post(`flights`,payload);    

        return data;
        
    }

    async update(payload){
        
        const token = localStorage.getItem('token');
        api.defaults.headers['Accept'] = 'application/json';
        api.defaults.headers['Authorization'] = `Bearer ${token}`;

        const { data } = await api.put(`flights/${payload.id}`,payload);    

        return data;
        
    }

    async delete(payload){
        
        const token = localStorage.getItem('token');
        api.defaults.headers['Accept'] = 'application/json';
        api.defaults.headers['Authorization'] = `Bearer ${token}`;

        const { data } = await api.delete(`flights/${payload}`);    

        return data;
        
    }

    

}
