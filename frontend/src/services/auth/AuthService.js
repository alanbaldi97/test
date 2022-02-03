import { api } from "src/boot/axios";
import { Store } from "src/store";



export class AuthService{

    async autenticate(){
        const token = localStorage.getItem('token');

        if(!token) return  {
            user:null,
            auth: false,
        };;

        try{

            const { data:user } = await api.get(`user`,{
                headers: {
                    Accept: 'application/json',
                    Authorization: `Bearer ${token}`
                }
            });

            Store.dispatch('auth/setUser',user);

            console.log(Store.getters)

            return {
                user: user,
                auth:true
            }

        }catch(error){
            console.log(error);
            return {
                user:null,
                auth: false,
            };
        }
        
    }

    async login( email, password ){
        try {
            const { data } = await api.post(`login`,{
                email,
                password
            });

            return data;

        } catch (error) {
            return null;
        }
    }

    async logOut(){
        try {
            const token = localStorage.getItem('token');
            api.defaults.headers['Accept'] = 'application/json';
            api.defaults.headers['Authorization'] = `Bearer ${token}`;
            
            

            const { data } = await api.post(`logout`);

            return data;

        } catch (error) {
            return null;
        }
    }

    can(name){
        let permissions = Store.getters['auth/permissions'];
        return permissions.indexOf(name) !== -1;
    }

}
