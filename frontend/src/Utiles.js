const EXTENSIONES_ICONOS = {
    "txt": "file-document-outline",
    "pdf": "file-pdf-box",
    "sql": "database",
    "exe": "microsoft-windows",
    "jpg": "image",
    "png": "image",
    "go": "language-go",
    "py": "language-python",
    "c": "language-c",
    "cpp": "language-cpp",
    "cs": "language-csharp",
    "java": "language-java",
    "js": "language-javascript",
    "mkv": "movie",
    "mp4": "movie",
    "avi": "movie",
};
const ICONO_POR_DEFECTO = "file";
const Utiles = {
    obtenerExtensionDeArchivo(nombreArchivo) {
        if (!nombreArchivo) {
            return "";
        }
        return nombreArchivo.substring(nombreArchivo.lastIndexOf(".") + 1);
    },
    obtenerIconoSegunNombreArchivo(nombreArchivo) {
        return EXTENSIONES_ICONOS[Utiles.obtenerExtensionDeArchivo(nombreArchivo)] || ICONO_POR_DEFECTO;
    }
};
export default Utiles;