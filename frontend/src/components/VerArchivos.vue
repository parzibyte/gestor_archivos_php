<template>
  <div>

    <div class="columns">
      <div class="column">
        <h2 class="is-size-2">Mis archivos</h2>
      </div>
    </div>
    <div class="columns">
      <div class="column">
        <b-table :data="archivos" :loading="cargando">
          <template>
            <b-table-column searchable field="nombre_original" label="Nombre" sortable v-slot="props">
              <b-icon :icon="obtenerIcono(props.row.nombre_original)">
              </b-icon>
              {{ props.row.nombre_original }}
            </b-table-column>
            <b-table-column searchable field="fecha_creacion" label="Fecha" sortable v-slot="props">
              {{ props.row.fecha_creacion }}
            </b-table-column>
            <b-table-column searchable field="tamanio_bytes" label="Tamaño" sortable v-slot="props">
              {{ props.row.tamanio_bytes | bytes_legibles }}
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
                <b-dropdown-item @click="descargar(props.row.id)" aria-role="listitem">
                  <b-icon icon="cloud-download"></b-icon>&nbsp;Descargar
                </b-dropdown-item>
                <b-dropdown-item aria-role="listitem">
                  <b-icon icon="share-variant"></b-icon>&nbsp;Compartir
                </b-dropdown-item>
                <b-dropdown-item aria-role="listitem">
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
import ArchivosService from "@/services/ArchivosService";
import Constantes from "@/Constantes";
import Utiles from "@/Utiles";

export default {
  name: "VerArchivos",
  mounted() {
    this.obtenerArchivos();
  },
  methods: {
    obtenerIcono(nombreArchivo) {
      return Utiles.obtenerIconoSegunNombreArchivo(nombreArchivo);
    },
    async obtenerArchivos() {
      this.archivos = await ArchivosService.obtenerArchivos();
    },
    descargar(id) {
      const url = Constantes.URL_SERVIDOR + "/descargar.php?id=" + id;
      window.open(url);
    }
  },
  data: () => ({
    archivos: [],
    cargando: false,
  }),
}
</script>
