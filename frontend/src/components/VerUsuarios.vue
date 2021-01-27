<template>
  <div>
    <b-modal :active.sync="mostrarModalCambiarPalabraSecreta"
             aria-modal
             aria-role="dialog"
             has-modal-card
             :destroy-on-hide="true"
             trap-focus>
      <CambiarPalabraSecreta :usuario="usuarioEditado" @cambiada="onPalabraSecretaCambiada"/>
    </b-modal>
    <div class="columns">
      <div class="column">
        <h2 class="is-size-2">Usuarios</h2>
      </div>
    </div>
    <div class="columns">
      <div class="column">
        <b-button @click="navegarHacia('CrearUsuario')" type="is-success" icon-right="plus">Agregar</b-button>
        <b-table :data="usuarios" :loading="cargando">
          <template>
            <b-table-column searchable field="correo" label="Correo" sortable v-slot="props">
              {{ props.row.correo }}
            </b-table-column>
            <b-table-column field="administrador" label="Administrador" sortable v-slot="props">
              <b-icon v-if="props.row.administrador" type="is-success" icon="check"></b-icon>
              <b-icon v-else type="is-danger" icon="close"></b-icon>
            </b-table-column>
            <b-table-column field="id" label="Opciones" v-slot="props">
              <b-dropdown :triggers="['click']" aria-role="list">
                <template #trigger>
                  <b-button
                      rounded
                      outlined
                      type="is-text"
                  >
                    <b-icon icon="dots-vertical"></b-icon>
                  </b-button>
                </template>
                <b-dropdown-item @click="cambiarPalabraSecreta(props.row)" aria-role="listitem">
                  <b-icon icon="form-textbox-password"></b-icon>&nbsp;Cambiar contraseña
                </b-dropdown-item>
                <b-dropdown-item v-show="!props.row.administrador" @click="hacerAdministrador(props.row.id)"
                                 aria-role="listitem">
                  <b-icon icon="account-star"></b-icon>&nbsp;Hacer administrador
                </b-dropdown-item>
                <b-dropdown-item v-show="props.row.administrador" @click="quitarPermisosAdministrador(props.row.id)"
                                 aria-role="listitem">
                  <b-icon icon="account-remove"></b-icon>&nbsp;Quitar permisos de administrador
                </b-dropdown-item>
                <b-dropdown-item @click="confirmarEliminacion(props.row.id)" aria-role="listitem">
                  <b-icon icon="delete"></b-icon>&nbsp;Eliminar
                </b-dropdown-item>
              </b-dropdown>
            </b-table-column>
          </template>
        </b-table>
      </div>
    </div>
  </div>

</template>

<script>
import EventBus from "@/EventBus";
import UsuariosService from "@/services/UsuariosService";
import NotificacionesService from "@/services/NotificacionesService";
import CambiarPalabraSecreta from "@/components/CambiarPalabraSecreta";

export default {
  name: "VerUsuarios",
  components: {CambiarPalabraSecreta},

  data: () => ({
    cargando: false,
    usuarios: [],
    mostrarModalCambiarPalabraSecreta: false,
    usuarioEditado: {},// El usuario al que se le cambia la contraseña
  }),
  mounted() {
    this.obtenerUsuarios();
  },
  methods: {
    async cambiarEstadoAdministrador(nuevoEstado, id) {
      this.cargando = true;
      try {
        const respuestsa = await UsuariosService.cambiarEstadoAdministrador(nuevoEstado, id);
        if (respuestsa) {

          NotificacionesService.mostrarNotificacionExito("Estado cambiado");
        } else {
          NotificacionesService.mostrarNotificacionError("Error cambiando estado");
        }
        this.obtenerUsuarios();
      } catch (e) {

        NotificacionesService.mostrarNotificacionError("Error cambiando estado: " + e);
      } finally {
        this.cargando = false;
      }

    },
    hacerAdministrador(id) {
      this.cambiarEstadoAdministrador(1, id);
    },
    quitarPermisosAdministrador(id) {
      this.cambiarEstadoAdministrador(0, id);
    },
    navegarHacia(nombreRuta) {
      EventBus.$emit("navegarHacia", nombreRuta);
    },
    async obtenerUsuarios() {
      this.cargando = true;
      this.usuarios = await UsuariosService.obtenerUsuarios();
      this.cargando = false;
    },
    cambiarPalabraSecreta(usuario) {
      this.usuarioEditado = usuario;
      this.mostrarModalCambiarPalabraSecreta = true;
    },
    async eliminar(id) {
      try {
        this.cargando = true;
        const respuesta = await UsuariosService.eliminarUsuario(id);
        if (respuesta) {
          await this.obtenerUsuarios();
          NotificacionesService.mostrarNotificacionExito("Usuario eliminado correctamente");
        } else {
          NotificacionesService.mostrarNotificacionError("Error eliminando usuario");
        }
      } catch (e) {
        NotificacionesService.mostrarNotificacionError(`Error eliminando usuario: ${e}`);
      } finally {
        this.cargando = false;
      }
    },
    confirmarEliminacion(id) {
      NotificacionesService.mostrarDialogoConfirmacion("¿Eliminar usuario?", () => {
        this.eliminar(id);
      });
    },
    onPalabraSecretaCambiada() {
      this.usuarioEditado = {};
      this.mostrarModalCambiarPalabraSecreta = false;
    },

  },

}
</script>
