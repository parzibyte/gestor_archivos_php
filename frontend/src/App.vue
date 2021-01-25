<template>
  <div>
    <nav style="min-height: 80px" class="navbar is-success" role="navigation"
         aria-label="main navigation">
      <div class="navbar-brand">
        <h1 class="navbar-item is-size-2">Drive</h1>
        <button class="navbar-burger is-success button" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="navbar-menu">
        <div class="navbar-start">
          <router-link v-show="logueado" class="navbar-item" :to='{name: "SubirArchivo"}'>SubirArchivo</router-link>
          <router-link v-show="logueado" class="navbar-item" :to='{name: "VerArchivos"}'>VerArchivos</router-link>
          <router-link v-show="logueado && esAdministrador" class="navbar-item" :to='{name: "VerUsuarios"}'>
            VerUsuarios
          </router-link>
        </div>
        <div class="navbar-end">
          <router-link v-show="logueado" class="navbar-item" :to='{name: "Logout"}'>Salir (<small>{{ correo }}</small>)
          </router-link>
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
    }
  },
  data: () => ({
    esAdministrador: false,
    logueado: false,
    deberiaMostrarMenu: false,
    correo: "",
  }),
}
</script>