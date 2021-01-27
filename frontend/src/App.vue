<template>
  <div>
    <nav style="min-height: 80px" class="navbar is-danger" role="navigation"
         aria-label="main navigation">
      <div class="navbar-brand">
        <h1 class="navbar-item is-size-2">Drive</h1>
        <button @click="menuEstaActivo = !menuEstaActivo" class="navbar-burger is-danger button" aria-label="menu"
                aria-expanded="false"
                data-target="navbarBasicExample">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div :class="{'is-active':menuEstaActivo}" class="navbar-menu">
        <div class="navbar-start">
          <a v-show="logueado" class="navbar-item" @click="navegarHacia('VerArchivos')">
            <b-icon class="mr-1" icon="cloud"></b-icon>&nbsp;
            Mis archivos
          </a>
          <a v-show="logueado && esAdministrador" class="navbar-item"
             @click="navegarHacia('VerUsuarios')">
            <b-icon class="mr-1" icon="account-multiple"></b-icon>&nbsp;
            Usuarios</a>
        </div>
        <div class="navbar-end">
          <a v-show="logueado" class="navbar-item" @click="navegarHacia('Logout')">Salir (<small>{{
              correo
            }}</small>)
          </a>
          <div class="navbar-item">
            <div class="buttons">
              <a target="_blank" rel="noreferrer" href="https://parzibyte.me/l/fW8zGd"
                 class="button is-primary">
                <strong>Soporte y ayuda</strong>
              </a>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <div class="section">
      <router-view/>
    </div>
  </div>
</template>

<script>

import EventBus from "@/EventBus";

export default {
  name: 'app',

  data: () => ({
    esAdministrador: false,
    logueado: false,
    deberiaMostrarMenu: false,
    correo: "",
    menuEstaActivo: false,
  }),
  mounted() {
    EventBus.$on("establecerUsuario", usuario => {
      this.refrescarUsuario(usuario);
    });
    EventBus.$on("cerrarSesion", () => {
      this.refrescarUsuario({});
    });
    EventBus.$on("navegarHacia", this.navegarHacia);
    EventBus.$on("mostrarMenu", this.mostrarMenu);
    EventBus.$on("ocultarMenu", this.ocultarMenu);
    this.obtenerUsuarioDeLocalStorage();
  },
  methods: {
    refrescarUsuario(usuario) {
      if (usuario.correo) {
        this.esAdministrador = Boolean(usuario.administrador);
        this.correo = usuario.correo;
        this.logueado = true;
      } else {
        this.esAdministrador = false;
        this.correo = "";
        this.logueado = false;
      }
    },
    obtenerUsuarioDeLocalStorage() {
      const usuario = EventBus.obtenerUsuario();
      this.refrescarUsuario(usuario);
    },
    mostrarMenu() {
      this.deberiaMostrarMenu = true;
    },
    ocultarMenu() {
      this.deberiaMostrarMenu = false;
    },
    navegarHacia(nombreRuta) {
      this.$router.push({name: nombreRuta});
      this.menuEstaActivo = false;
    }
  },

}
</script>