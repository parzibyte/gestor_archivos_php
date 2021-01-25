<template>
  <b-icon :icon="icono">
  </b-icon>
</template>

<script>
import Utiles from "@/Utiles";

export default {
  props: ["nombreArchivo"],
  name: "IconoDeArchivo",
  mounted() {
    this.icono = Utiles.obtenerIconoSegunNombreArchivo(this.nombreArchivo);
  },
  data: () => ({
    icono: "file",
  }),
}
</script>

