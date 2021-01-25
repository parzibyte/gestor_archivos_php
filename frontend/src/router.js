import Vue from 'vue'
import Router from 'vue-router'
import SubirArchivo from '@/components/SubirArchivo'
import Login from '@/components/Login'
import Logout from '@/components/Logout'
import CrearUsuario from '@/components/CrearUsuario'
import VerArchivos from '@/components/VerArchivos'
import EventBus from "@/EventBus";

Vue.use(Router);

const router = new Router({
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
        }, {
            path: '/logout',
            name: 'Logout',
            component: Logout,
        },
        {
            path: '/archivos',
            name: 'VerArchivos',
            component: VerArchivos,
        }
    ]
});
router.beforeEach((to, from, next) => {
    if (to.name !== 'Login' && !EventBus.obtenerUsuario().correo) {
        return next({name: 'Login'});
    }
    if (to.name !== 'Login') {
        EventBus.$emit('mostrarMenu');
    } else {
        EventBus.$emit('ocultarMenu');
    }
    return next();
});
export default router;