<template>
  <div>
    <h1>Estamos cerrando sesión</h1>
    <p>Espera...</p>
  </div>
</template>

<script>
import UsuariosService from "@/services/UsuariosService";
import EventBus from "@/EventBus";

export default {
  name: "Logout",
  async mounted() {
    await UsuariosService.logout();
    EventBus.$emit("navegarHacia", "Login");
  }
}
</script>