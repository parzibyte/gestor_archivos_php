<template>
  <div class="columns">
    <div class="column">
      <h2 class="is-size-2 has-text-centered">Subir archivos</h2>
      <b-field>
        <b-upload :loading="cargando" v-model="archivos"
                  multiple
                  ref="inputArchivos"
                  drag-drop>
          <section class="section">
            <div class="content has-text-centered">
              <p>
                <b-icon
                    icon="upload"
                    size="is-large">
                </b-icon>
              </p>
              <p>Arrastra aquí los archivos o haz clic para buscarlos</p>
            </div>
          </section>
        </b-upload>
      </b-field>
      <div class="tags">
            <span v-for="(archivo, indice) in archivos"
                  :key="indice"
                  class="tag is-primary">
                {{ archivo.name }}
                <button class="delete is-small"
                        type="button"
                        @click="eliminarArchivo(indice)">
                </button>
            </span>
      </div>
      <b-field>
        <b-button :loading="cargando" @click="subirArchivos()" :disabled="archivos.length <= 0" type="is-success">
          Subir
        </b-button>
      </b-field>

    </div>
  </div>
</template>
<script>
import ArchivosService from "@/services/ArchivosService";
import NotificacionesService from "@/services/NotificacionesService";

export default {
  data() {
    return {
      archivos: [],
      cargando: false,
    }
  },
  methods: {
    eliminarArchivo(indice) {
      this.archivos.splice(indice, 1)
    },
    async subirArchivos() {
      if (this.archivos.length <= 0) {
        return;
      }
      try {
        this.cargando = true;
        const respuesta = await ArchivosService.subirArchivos(this.archivos);
        if (respuesta) {
          NotificacionesService.mostrarNotificacionExito("Archivo(s) subido(s) correctamente");
        } else {
          NotificacionesService.mostrarNotificacionError("Error subiendo archivos");
        }
      } catch (e) {
        NotificacionesService.mostrarNotificacionError(`Error subiendo archivos: ${e}`);
      } finally {
        this.archivos = [];
        this.cargando = false;
      }
    }
  }
}
</script>