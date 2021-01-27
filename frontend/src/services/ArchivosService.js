import HttpService from "@/services/HttpService";

const ArchivosService = {
    async eliminarArchivo(idArchivo) {
        return await HttpService.post("/eliminar_archivo.php", idArchivo);
    },
    async obtenerArchivos() {
        return await HttpService.get("/obtener_archivos.php");
    },
    async subirArchivos(archivos) {
        const formData = new FormData();
        for (const archivo of archivos) {
            formData.append("archivos[]", archivo);
        }
        return await HttpService.formdata("/subir_archivos.php", formData);
    },
    async compartir(idArchivo) {
        return await HttpService.post("/compartir_archivo.php", {idArchivo});
    },
    async detallesCompartido(idArchivo) {
        return await HttpService.post("/detalles_archivo_compartido.php", {idArchivo});
    }
};
export default ArchivosService;