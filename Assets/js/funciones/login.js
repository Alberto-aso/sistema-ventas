//----------------Funcion login-----------------//
function frmLogin(e) {
  e.preventDefault(); //Prevenir la recarga de la pagina
  const usuario = document.getElementById("usuario"); //Seleccionamos el input
  const clave = document.getElementById("clave"); //Seleccionamos el input

  if (usuario.value == "") { //Evaluamos si tiene contenido
    $("#clave").removeClass('is-invalid'); //Removemos clase
    $("#usuario").addClass('is-invalid'); //Agregamos clase
    usuario.focus();
  } else if (clave.value == "") { //Evaluamos si tiene contenido
    $("#usuario").removeClass('is-invalid'); //Removemos clase
    $("#clave").addClass('is-invalid'); //Agregamos clase
    clave.focus();
  } else {
    const url = base_url + "Usuarios/validar"; //Creamos la constante de la url a donde se enviara el formulario
    const frm = document.getElementById("frmLogin"); //Creamos la contante y jalamos el fomulario que sera enviado
    const http = new XMLHttpRequest(); //
    http.open("POST", url, true); //Enviamos com POST y el url y true como asincrona
    http.send(new FormData(frm)); //Mandamos le formulario como FormData
    http.onreadystatechange = function () { //Ejecutamos la funcon para verificar el estatus de la peticion
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);

        if (res == "ok") {
          window.location = base_url + "Usuarios";
        }else{
          document.getElementById('alertaLogin').innerHTML = res;
          $("#alertaLogin").removeClass('d-none'); //Removemos clase
        }
      }
    }
  }
}