<template>
  <div class="modal-card" style="width: auto">
    <header class="modal-card-head">
      <p class="modal-card-title">Cambiando contraseña</p>
    </header>
    <section class="modal-card-body">
      <p class="mb-2"><strong>Correo:&nbsp;</strong>{{ usuario.correo }}</p>
      <b-field label="Contraseña actual">
        <b-input :loading="cargando" required ref="fieldPalabraSecretaActual" type="password"
                 placeholder="Escribe la contraseña actual"
                 v-model="palabraSecretaActual"></b-input>
      </b-field>
      <b-field label="Nueva contraseña">
        <b-input :loading="cargando" required ref="fieldPalabraSecreta" type="password"
                 placeholder="Escribe la nueva contraseña"
                 v-model="palabraSecreta"></b-input>
      </b-field>
      <b-field label="Confirmar contraseña">
        <b-input :loading="cargando" required ref="fieldPalabraSecretaConfirmar" type="password"
                 placeholder="Vuelve a escribir la contraseña"
                 v-model="palabraSecretaConfirmar"></b-input>
      </b-field>
    </section>
    <footer class="modal-card-foot">
      <b-button :loading="cargando" @click="cerrarModal" class="button">Cancelar</b-button>
      <b-button :loading="cargando" @click="cambiarPalabraSecreta" class="button is-info">Cambiar</b-button>
    </footer>
  </div>
</template>

<script>
import NotificacionesService from "@/services/NotificacionesService";
import UsuariosService from "@/services/UsuariosService";

export default {
  name: "CambiarPalabraSecreta",
  props: ["usuario"],
  data: () => ({
    cargando: false,
    palabraSecretaActual: "",
    palabraSecreta: "",
    palabraSecretaConfirmar: "",
  }),
  methods: {
    cerrarModal() {
      this.$parent.close();
    },
    async cambiarPalabraSecreta() {
      const fields = ["fieldPalabraSecretaActual", "fieldPalabraSecreta", "fieldPalabraSecretaConfirmar"];
      for (const field of fields) {
        if (!this.$refs[field].checkHtml5Validity()) {
          return;
        }
      }
      if (this.palabraSecreta !== this.palabraSecretaConfirmar) {
        NotificacionesService.mostrarNotificacionError("La nueva contraseña no coincide con su confirmación");
        return;
      }
      this.cargando = true;
      try {
        const respuesta = await UsuariosService.actualizarPalabraSecreta(this.usuario.id, this.palabraSecretaActual, this.palabraSecreta);
        if (respuesta) {
          NotificacionesService.mostrarNotificacionExito("Contraseña cambiada correctamente");
          this.$emit("cambiada");
        } else {
          NotificacionesService.mostrarNotificacionError("Error cambiando contraseña. Puede que la contraseña actual no coincida");
        }
      } catch (e) {
        NotificacionesService.mostrarNotificacionError("Error cambiando contraseña: " + e);
      } finally {
        this.cargando = false;
      }
    }
  }
}
</script>

<style scoped>

</style>