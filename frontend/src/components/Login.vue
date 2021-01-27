<template>
  <div class="has-text-centered">
    <div class="column is-12 is-4-desktop is-offset-4-desktop">
      <h1 class="title has-text-grey">Bienvenido</h1>
      <p class="subtitle has-text-grey">Inicia sesión</p>
      <div class="box">
        <figure class="image is-128x128 container mb-2">
          <img class="is-rounded" style="width: 130px;" src="https://picsum.photos/id/0/200"/>
        </figure>
        <b-field label="Correo">
          <b-input :loading="cargando" required ref="fieldCorreo" placeholder="tu@correo.aquí" type="email"
                   v-model="correo"></b-input>
        </b-field>
        <b-field label="Contraseña">
          <b-input :loading="cargando" required ref="fieldPalabraSecreta" type="password"
                   placeholder="Escribe tu contraseña"
                   v-model="palabraSecreta"></b-input>
        </b-field>
        <b-field>
          <b-button :loading="cargando" @click="iniciarSesion()" type="is-success">Iniciar sesión</b-button>
        </b-field>
      </div>
    </div>
  </div>
</template>

<script>
import UsuariosService from "@/services/UsuariosService";
import NotificacionesService from "@/services/NotificacionesService";
import EventBus from "@/EventBus";

export default {
  name: "Login",
  data: () => ({
    correo: "",
    palabraSecreta: "",
    cargando: false,
  }),
  methods: {
    async iniciarSesion() {
      const fields = ["fieldCorreo", "fieldPalabraSecreta"];
      for (const field of fields) {
        if (!this.$refs[field].checkHtml5Validity()) {
          return;
        }
      }
      try {
        this.cargando = true;
        const usuarioLogueado = await UsuariosService.login(this.correo, this.palabraSecreta);
        if (usuarioLogueado) {
          NotificacionesService.mostrarNotificacionExito("Bienvenido");
          EventBus.establecerUsuario(usuarioLogueado);
          EventBus.$emit("navegarHacia", "SubirArchivo");
          this.correo = this.palabraSecreta = "";
        } else {
          NotificacionesService.mostrarNotificacionError("Usuario o contraseña incorrectos");
        }
      } catch (e) {
        NotificacionesService.mostrarNotificacionError(`Error iniciando sesión: ${e}`);
      } finally {
        this.cargando = false;
      }
    }
  }
}
</script>

<style scoped>

</style>