<template>
  <div>
    <h1 class="is-size-1">Estamos cerrando sesión</h1>
    <p>Espera...</p>
    <p>Si estás viendo esto por mucho tiempo, sería bueno refrescar la página. Esto suele pasar
      cuando no cierras sesión antes de cerrar el navegador</p>
  </div>
</template>

<script>
import UsuariosService from "@/services/UsuariosService";
import EventBus from "@/EventBus";
import NotificacionesService from "@/services/NotificacionesService";

export default {
  name: "Logout",
  async mounted() {
    EventBus.eliminarUsuario();
    await UsuariosService.logout();
    EventBus.$emit("navegarHacia", "Login");
    NotificacionesService.mostrarNotificacionExito("Hasta pronto");
  }
}
</script>