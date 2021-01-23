import Vue from 'vue'
import Router from 'vue-router'
import Hola from '@/components/Hola'
import Perfil from '@/components/Perfil'
import SubirArchivo from '@/components/SubirArchivo'

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'Hola',
            component: Hola
        },
        {
            path: '/perfil',
            name: 'Perfil',
            component: Perfil,
        },
        {
            path: '/subir',
            name: 'SubirArchivo',
            component: SubirArchivo,
        }
    ]
});