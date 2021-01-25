import {NotificationProgrammatic as Notification} from 'buefy'
import {DialogProgrammatic as Dialog} from 'buefy'

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
    },
    mostrarDialogoConfirmacion(pregunta, callback, mensajeOk, mensajeCancelar) {
        mensajeOk = mensajeOk || "Ok";
        mensajeCancelar = mensajeCancelar || "Cancelar";
        Dialog.confirm({
            title: 'Confirmar',
            message: pregunta,
            cancelText: mensajeCancelar,
            confirmText: mensajeOk,
            type: 'is-danger',
            onConfirm: callback,
        });
    }
};
export default NotificacionesService;