import Vue from 'vue';
// Comunicación entre componentes

const CLAVE_LOCALSTORAGE_USUARIO = "usuario";
export const EventBus = new Vue({
    data: () => ({
        usuario: {},
    }),
    methods: {
        eliminarUsuario() {
            localStorage.removeItem(CLAVE_LOCALSTORAGE_USUARIO);
            this.$emit('cerrarSesion');
        },
        obtenerUsuario() {
            const posibleUsuario = localStorage.getItem(CLAVE_LOCALSTORAGE_USUARIO);
            if (!posibleUsuario) {
                return {};
            }
            return JSON.parse(posibleUsuario);
        },
        establecerUsuario(usuario) {
            this.usuario = usuario;
            this.$emit('establecerUsuario', usuario);
            localStorage.setItem(CLAVE_LOCALSTORAGE_USUARIO, JSON.stringify(usuario));
        },
    },
});
export default EventBus;