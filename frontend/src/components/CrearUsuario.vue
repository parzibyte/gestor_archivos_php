<template>
  <div class="columns">
    <div class="column">
      <h2 class="is-size-2">Agregar usuario</h2>
      <b-field label="Correo">
        <b-input :loading="cargando" required ref="fieldCorreo" placeholder="tu@correo.aquí" type="email"
                 v-model="correo"></b-input>
      </b-field>
      <b-field label="Contraseña">
        <b-input :loading="cargando" required ref="fieldPalabraSecreta" type="password"
                 placeholder="Escribe la contraseña"
                 v-model="palabraSecreta"></b-input>
      </b-field>
      <b-field label="Confirmar contraseña">
        <b-input :loading="cargando" required ref="fieldPalabraSecretaConfirmar" type="password"
                 placeholder="Vuelve a escribir la contraseña"
                 v-model="palabraSecretaConfirmar"></b-input>
      </b-field>
      <b-field label="¿Administrador?">
        <b-checkbox v-model="administrador">
          {{ administrador ? "Sí" : "No" }}
        </b-checkbox>
      </b-field>
      <b-field>
        <b-button :loading="cargando" @click="agregarUsuario()" type="is-success">Guardar</b-button>
      </b-field>
    </div>
  </div>
</template>

<script>
import NotificacionesService from "@/services/NotificacionesService";
import UsuariosService from "@/services/UsuariosService";

export default {
  name: "CrearUsuario",
  data: () => ({
    cargando: false,
    correo: "",
    administrador: false,
    palabraSecreta: "",
    palabraSecretaConfirmar: "",
  }),
  methods: {
    async agregarUsuario() {
      const fields = ["fieldCorreo", "fieldPalabraSecreta", "fieldPalabraSecretaConfirmar"];
      for (const field of fields) {
        if (!this.$refs[field].checkHtml5Validity()) {
          return;
        }
      }
      if (this.palabraSecreta !== this.palabraSecretaConfirmar) {
        NotificacionesService.mostrarNotificacionError("Las contraseñas no coinciden");
        return;
      }
      try {
        this.cargando = true;
        const respuesta = await UsuariosService.crearUsuario(this.correo, this.palabraSecreta, this.administrador);
        if (respuesta) {
          NotificacionesService.mostrarNotificacionExito("Usuario creado correctamente");
          this.correo = this.palabraSecreta = this.palabraSecretaConfirmar = "";
        } else {
          NotificacionesService.mostrarNotificacionError("Error creando usuario ");
        }
      } catch (e) {
        NotificacionesService.mostrarNotificacionError(`Error creando usuario: ${e}`);
      } finally {
        this.cargando = false;
      }
    }
  },
}
</script>

<style scoped>

</style>