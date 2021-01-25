import HttpService from "@/services/HttpService";

const UsuariosService = {
    async crearUsuario(correo, palabraSecreta, administrador) {
        const cargaUtil = {correo, palabraSecreta, administrador};
        return await HttpService.post("/crear_usuario.php", cargaUtil);
    },
    async login(correo, palabraSecreta) {
        const cargaUtil = {correo, palabraSecreta};
        return await HttpService.post("/login.php", cargaUtil);
    },
    async logout() {
        return await HttpService.get("/logout.php");
    },
    async obtenerUsuarios() {
        return await HttpService.get("/obtener_usuarios.php");
    },
    async eliminarUsuario(id) {
        return await HttpService.post("/eliminar_usuario.php", id);
    }
};
export default UsuariosService;
