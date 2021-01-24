import Vue from 'vue'
import Router from 'vue-router'
import SubirArchivo from '@/components/SubirArchivo'
import Login from '@/components/Login'
import CrearUsuario from '@/components/CrearUsuario'

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/subir',
            name: 'SubirArchivo',
            component: SubirArchivo,
        },
        {
            path: '/login',
            name: 'Login',
            component: Login,
        },
        {
            path: '/crear-usuario',
            name: 'CrearUsuario',
            component: CrearUsuario,
        }
    ]
});