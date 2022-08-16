//Asignando variables a los elementos del html
formulario = document.getElementById("formulario");
selectRegion = document.getElementById("region");

//Los métodos 'add' agregan un evento a las variables
formulario.addEventListener("submit", validar);
selectRegion.addEventListener("change", cambiarComuna);

//Objeto con dos funciones para validar el rut
//URL: https://gist.github.com/donpandix/f1d638c3a1a908be02d5
var Fn = {
    validaRut: function(rutCompleto) {
        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto))
            return false;
        var tmp = rutCompleto.split('-');
        var digv = tmp[1];
        var rut = tmp[0];
        if (digv == 'K') digv = 'k';
        return (Fn.dv(rut) == digv);
    },
    dv: function(T) {
        var M = 0,
            S = 1;
        for (; T; T = Math.floor(T / 10))
            S = (S + T % 10 * (9 - M++ % 6)) % 11;
        return S ? S - 1 : 'k';
    }
}

function validar(evento) {
    //Obtener valores de los input segun id
    nom_ap = document.getElementById("nom_ap").value;
    alias = document.getElementById("alias").value;
    rut = document.getElementById("rut").value;
    email = document.getElementById("email").value;
    region = document.getElementById("region").value;
    comuna = document.getElementById("comuna").value;
    candidato = document.getElementById("candidato").value;
    web = document.getElementById("web").checked;
    tv = document.getElementById("tv").checked;
    redes_s = document.getElementById("redes_s").checked;
    amigo = document.getElementById("amigo").checked;

    //Cancela submit o envio del formulario
    evento.preventDefault();

    //Validaciones
    if (nom_ap.length == 0) {
        alert("El nombre y apellido no pueden estar vacios");
        return;
    }
    patron = new RegExp(/^[A-Za-z0-9]{5,}$/);
    if (!patron.test(alias)) {
        alert("Alias con formato incorrecto, porfavor verifique");
        return;
    }
    if (comuna.length == 0 || region.length == 0) {
        alert("Debe seleccionar comuna y región");
        return;
    }

    patron = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (!patron.test(email)) {
        alert("Formato de email incorrecto o vacio, porfavor verifique");
        return;
    }

    if (candidato.length == 0) {
        alert("Debe ingresar un candidato");
        return;
    }
    con = 0;
    if (web == true) {
        con++;
    }
    if (tv == true) {
        con++;
    }
    if (redes_s == true) {
        con++;
    }
    if (amigo == true) {
        con++;
    }
    if (con < 2) {
        alert("Debe seleccionar almenos dos opciones de medios de contacto");
        return;
    }
    if (!Fn.validaRut(rut)) {
        alert("Ingrese un rut válido sin puntos y con digíto verificador");
        return;
    }
    //enviar formulario
    this.submit();

}

function cambiarComuna(evento) {
    //objeto que envía una consulta para obtener la comuna según el id de región
    $.ajax({
        type: "POST", //Propiedad de tipo POST 
        url: 'consultas.php', //Url donde se va a mandar la consulta
        data: {
            id_region: this.value,
            tipo_consulta: 'obtener_comuna',
        }, //Datos que se envian en la consulta
        success: function(respuesta) //funcion cuando la consulta esta bien
            {
                $('#comuna').html(respuesta);
            }
    });
}

function obtenerRegion() {
    //objeto que envia una consulta para obtener la región de la BD
    $.ajax({
        type: "POST",
        url: 'consultas.php',
        data: { tipo_consulta: 'obtener_region' },
        success: function(respuesta) {
            $('#region').html(respuesta);
        }
    })
}
//llamando la funcion de obtener región
obtenerRegion();