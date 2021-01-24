import Constantes from "@/Constantes";

const HttpService = {
    "formdata": async (ruta, fd) => {
        const respuestaRaw = await fetch(Constantes.URL_SERVIDOR + ruta, {
            credentials: "include",
            method: "POST",
            body: fd,
        });
        return await respuestaRaw.json();
    },
    "post": async (ruta, datos) =>
        fetch(Constantes.URL_SERVIDOR + ruta, {
            credentials: 'include',
            method: "POST",
            body: JSON.stringify(datos)
        })
            .then(r => r.json())
    ,
    "put": async (ruta, datos) =>
        fetch(Constantes.URL_SERVIDOR + ruta, {
            credentials: 'include',
            method: "PUT",
            body: JSON.stringify(datos)
        })
            .then(r => r.json())
    ,
    "get": async (ruta) =>
        fetch(Constantes.URL_SERVIDOR + ruta, {
            credentials: 'include',
        })
            .then(r => r.json())
    ,
    "delete": async (ruta) =>
        fetch(Constantes.URL_SERVIDOR + ruta, {
            credentials: 'include',
            method: "DELETE",
        })
            .then(r => r.json())
};
export default HttpService;