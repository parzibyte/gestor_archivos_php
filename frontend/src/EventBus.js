import Vue from 'vue';
// Comunicación entre componentes

export const EventBus = new Vue({
    data: () => ({
        usuario: {},
    }),
    methods: {
        obtenerUsuario() {
            return this.usuario;
        },
        establecerUsuario(usuario) {
            this.usuario = usuario;
            this.$emit('establecerUsuario', usuario);
        },
    },
});
export default EventBus;