import Constantes from "@/Constantes";

const ArchivosService = {
    async subirArchivos(archivos) {
        const formData = new FormData();
        for (const archivo of archivos) {
            formData.append("archivos[]", archivo);
        }
        const respuestaRaw = await fetch(`${Constantes.URL_SERVIDOR}/guardar.php`, {
            method: "POST",
            body: formData,
        });
        return await respuestaRaw.json();
    }
};
export default ArchivosService;