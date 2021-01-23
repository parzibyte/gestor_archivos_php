import {NotificationProgrammatic as Notification} from 'buefy'

const NotificacionesService = {
    mostrarNotificacionExito(mensaje) {
        Notification.open({
            message: mensaje,
            type: 'is-info',
            position: "is-top-left"
        });
    },
    mostrarNotificacionError(mensaje) {
        Notification.open({
            message: mensaje,
            type: 'is-danger',
            position: "is-top-left"
        });
    }
};
export default NotificacionesService;