<template>
  <div class="modal-card" style="width: auto">
    <header class="modal-card-head">
      <p class="modal-card-title">Detalles de archivo compartido</p>
    </header>
    <section class="modal-card-body">
      <div class="notification is-primary">
        <p>
          <strong>Nombre:&nbsp;</strong>{{ archivo.nombre_original }}
        </p>
        <p>
          <strong>Creado:&nbsp;</strong>{{ archivo.fecha_creacion }}
        </p>
        <p>
          <strong>Tamaño:&nbsp;</strong>{{ archivo.tamanio_bytes | bytes_legibles }}
        </p>
      </div>

      <div v-show="cargando">
        Cargando...
      </div>
      <div v-show="compartido && !cargando">
        <p>
          Este archivo está compartido en
          <a target="_blank" :href="enlaceCompartido">este enlace</a>. También puedes copiarlo:
        </p>
        <b-field>
          <b-input readonly expanded :value="enlaceCompartido"></b-input>
          <p class="control">
            <b-tooltip type="is-warning" position="is-left" label="Copiar">
              <b-button @click="copiar()" class="button is-success">
                <b-icon icon="content-copy"></b-icon>
              </b-button>
            </b-tooltip>
          </p>
        </b-field>
        Cualquier persona con el enlace puede descargar el archivo.
        <br>
        Recuerda que puedes dejar de compartir y volver a compartir para generar otro enlace
        <br>
        <b-button @click="confirmarDejarDeCompartir()" class="mt-1" icon-right="share-off" type="is-danger">Dejar de
          compartir
        </b-button>
      </div>
      <div v-show="!compartido && !cargando">
        <p>Este archivo no está compartido. <strong>Solo tú puedes descargarlo</strong></p>
        <b-button @click="confirmarCompartir()" class="mt-1" icon-right="share" type="is-success">Compartir</b-button>
      </div>
    </section>
    <footer class="modal-card-foot">
      <b-button :loading="cargando" @click="cerrarModal" class="button">Cerrar</b-button>
    </footer>
  </div>
</template>

<script>
import NotificacionesService from "@/services/NotificacionesService";
import ArchivosService from "@/services/ArchivosService";
import Constantes from "@/Constantes";

export default {
  name: "CompartirArchivo",
  props: ["archivo"],
  data: () => ({
    cargando: false,
    compartido: false,
    hash: "",
  }),
  async mounted() {
    await this.obtenerDetalles();
  },
  computed: {
    enlaceCompartido() {
      return this.obtenerEnlaceParaCompartir();
    },
  },
  methods: {
    obtenerEnlaceParaCompartir() {
      return Constantes.URL_SERVIDOR + "/descargar_compartido.php?hash=" + this.hash;
    },
    async copiar() {
      try {
        await navigator.clipboard.writeText(this.obtenerEnlaceParaCompartir());
        NotificacionesService.mostrarNotificacionExito("Copiado");
      } catch (e) {
        NotificacionesService.mostrarNotificacionExito("Error copiando. Tal vez no estás en localhost ni en un lugar con https. El error es: " + e);
      }
    },
    async confirmarDejarDeCompartir() {
      NotificacionesService.mostrarDialogoConfirmacion("¿Seguro que quieres dejar de compartir este archivo?", () => {
        this.dejarDeCompartir();
      }, "Sí, dejar de compartir", "Seguir compartiendo");
    },
    async dejarDeCompartir() {
      this.cargando = true;
      try {
        const respuesta = await ArchivosService.dejarDeCompartir(this.archivo.id);
        if (respuesta) {
          NotificacionesService.mostrarNotificacionExito("El archivo ya no está compartido");
        } else {
          NotificacionesService.mostrarNotificacionExito("Error dejando de compartir archivo");
        }
      } catch (e) {
        NotificacionesService.mostrarNotificacionError("Error dejando de compartir archivo: " + e);
      } finally {
        this.cargando = false;
        this.obtenerDetalles();
      }
    },
    cerrarModal() {
      this.$parent.close();
    },
    async confirmarCompartir() {
      NotificacionesService.mostrarDialogoConfirmacion("¿Seguro que quieres compartir este archivo?", () => {
        this.compartir();
      }, "Sí, compartir", "No");
    },
    async compartir() {
      this.cargando = true;
      try {
        const respuesta = await ArchivosService.compartir(this.archivo.id);
        if (respuesta) {
          NotificacionesService.mostrarNotificacionExito("Archivo compartido");
        } else {
          NotificacionesService.mostrarNotificacionExito("Error compartiendo archivo");
        }
      } catch (e) {
        NotificacionesService.mostrarNotificacionError("Error compartiendo: " + e);
      } finally {
        this.cargando = false;
        this.obtenerDetalles();
      }
    },
    async obtenerDetalles() {
      this.cargando = true;
      try {
        const detalles = await ArchivosService.detallesCompartido(this.archivo.id);
        if (detalles) {
          this.compartido = true;
          this.hash = detalles.hash;
        } else {
          this.compartido = false;
          this.hash = "";
        }
      } catch (e) {
        NotificacionesService.mostrarNotificacionError("Error obteniendo detalles de archivo compartido: " + e);
      } finally {
        this.cargando = false;
      }
    }
  }
}
</script>
