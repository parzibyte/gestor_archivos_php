<template>
    <div class="container">
      <div class="columns">
        <div class="column">
          <section>
            <h1 class="is-size-1">Probando Buefy</h1>
            <button class="button is-medium" @click="mostrarToast">
                Mostrar un toast
            </button>
          </section>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  name: 'app',
  methods: {
    mostrarToast(){
      this.$buefy.toast.open("¡Hola, Buefy! Parzibyte.me")
    }
  }
}
</script>