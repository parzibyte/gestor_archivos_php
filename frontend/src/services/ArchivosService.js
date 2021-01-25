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
    }
};
export default ArchivosService;