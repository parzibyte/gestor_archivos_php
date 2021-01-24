<template>
  <div>
    <nav style="min-height: 80px" class="navbar is-success" role="navigation" aria-label="main navigation">
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
          <router-link class="navbar-item" :to='{name: "Hola"}'>Hola</router-link>
          <router-link class="navbar-item" :to='{name: "Perfil"}'>Perfil</router-link>
          <router-link class="navbar-item" :to='{name: "SubirArchivo"}'>SubirArchivo</router-link>
          <router-link class="navbar-item" :to='{name: "Login"}'>Login</router-link>
          <router-link class="navbar-item" :to='{name: "CrearUsuario"}'>CrearUsuario</router-link>
        </div>
        <div class="navbar-end">
          <a class="navbar-item" href="#">Enlace a la derecha</a>
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

export default {
  name: 'app',
  methods: {
    mostrarToast() {
      this.$buefy.toast.open("¡Hola, Buefy! Parzibyte.me")
    }
  }
}
</script>