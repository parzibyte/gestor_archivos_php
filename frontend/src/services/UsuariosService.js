import HttpService from "@/services/HttpService";

const UsuariosService = {
    async crearUsuario(correo, palabraSecreta) {
        const cargaUtil = {correo, palabraSecreta};
        return await HttpService.post("/crear_usuario.php", cargaUtil);
    },
    async login(correo, palabraSecreta) {
        const cargaUtil = {correo, palabraSecreta};
        return await HttpService.post("/login.php", cargaUtil);
    }
};
export default UsuariosService;
