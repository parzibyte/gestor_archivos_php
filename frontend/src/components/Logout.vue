<template>
  <div>
    <h1>Estamos cerrando sesión</h1>
    <p>Espera...</p>
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