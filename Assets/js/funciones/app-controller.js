//============================================================== SISTEMA DE VENTAS  CONTROLLER==========================================================//
//======================================================================================================================================================//
let tblUsuarios; //Creamos la constante de la tabla Usuarios
document.addEventListener('DOMContentLoaded', function () {
    tblUsuarios = $('#tblUsuarios').DataTable({ //Declaramos el Id de la tabla
        ajax: {
            url: base_url + "Usuarios/listar", //Mandamos a llamar al metodo listar del controlador
            dataSrc: '',
        },
        columns: [
            {
                'data': 'id', //Obtenemos el dato
            },
            {
                'data': 'num_empleado', //Obtenemos el dato
            },
            {
                'data': 'nombre', //Obtenemos el dato
            },
            {
                'data': 'caja', //Obtenemos el dato
            },
            {
                'data' : 'activo',
            },
            {
                'data' : 'acciones'
            },
        ],
        dom: 'lBfrtip', "responsive": true, "lengthChange": true, "autoWidth": false,
        buttons: [
            'copy',
            'excel',
            {
                extend: 'print',
                text: 'Print',
                title: 'LISTA DE USUARIOS',
                footer: false,
                customize: function (win) {
                    $(win.document.body)
                        .css('font-size', '10pt')
                        .prepend(
                            '<img src="' + base_url + 'Assets/img/Telecel logo.svg' + '" style="position:absolute; top:0; right:0;" />',
                        );
                    $(win.document.body)
                        .append('<div style=" margin-top: 50px;text-align: center;margin-left: 250px;">' +
                            '<div style="float:left;margin-right:100px;">' + '<p>Gerente OYM Telcel R3</p>' +
                            '<div style="border-top: 1px solid black;height: 2px;max-width: 200px;padding: 0;margin: 50px auto 0 auto;">' +
                            '<p>ING.MIGUEL ANGEL GARCIA SOTO</p>'
                            + '</div>'
                            + '</div>' +
                            '<div style="display: table-cell;">' + '<p>Solicito Reporte</p>' +
                            '<div style="border-top: 1px solid black;height: 2px;max-width: 200px;padding: 0;margin: 50px auto 0 auto;">' +
                            '<p>ING.' + 'ALBERTO SANCHEZ ORTIZ' +'</p >'
                            + '</div>'
                            + '</div>'
                            + '</div>'
                        ); //after the table
                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            },
            {
                extend: 'colvis',
                text:'Visualizar',
            }
        ],
    });
});

function btnEditarUser(id) { //Creamos la funcion para abrir modal con id para registrar usuario 
    document.getElementById("title_nuevo_usuario").innerHTML = "Actualizar Usuario";
    document.getElementById("btn_nuevo_usuario").innerHTML = "Update";
    document.getElementById('num_empleado').readOnly = true;
    document.getElementById('claves').classList.add('d-none');
    const url = base_url + "Usuarios/editUser/" + id; //Constante url para controlador
    const http = new XMLHttpRequest(); //htto request metodo
    http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
    http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
    http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
        if (this.readyState == 4 && this.status == 200) {

            const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

            document.getElementById('id_empleado').value = res.id; //Guardamos el id del usuario a editar
            document.getElementById('num_empleado').value = res.num_empleado;
            document.getElementById('nombre').value = res.nombre;//Guardamos la variable obtenida de la peticion
            document.getElementById('clave').value = res.clave;//Guardamos la variable obtenida de la peticion
            document.getElementById('confirmar').value = res.clave;//Guardamos la variable obtenida de la peticion
            document.getElementById('caja_id').value = res.id_caja; //Guardamos la variable obtenida de la peticion
        }
    }

    $('#nuevo_usuario').modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#nuevo_usuario").modal("show"); //Abrimos el modal con la clase estatico
}

function frmUsuario() { //Creamos la funcion para abrir le modal para nuevo Usuario
    document.getElementById("title_nuevo_usuario").innerHTML = "Nuevo Usuario";
    document.getElementById("btn_nuevo_usuario").innerHTML = "Save";
    document.getElementById('claves').classList.remove('d-none'); //Habilitamos la vista para las claves porque e snuevo 
    $('#nuevo_usuario').modal({ //Le damos las propiedades necesarias al modal para que no cierre
        backdrop: 'static',
        keyboard: false
    });
    $("#nuevo_usuario").modal("show"); //Mostramos el Modale
}

function registrarUser(e) { //Creamos la funcion para registrar o editar usuario
    e.preventDefault(); //Creamos el prevent defaul para evitar la recarga de la pagina
    const num_empleado = document.getElementById("num_empleado"); //Guardamos elemento por id
    const nombre = document.getElementById("nombre");//Guardamos elemento por id
    const clave = document.getElementById("clave");//Guardamos elemento por id
    const confirmar = document.getElementById("confirmar");//Guardamos elemento por id
    const caja_id = document.getElementById("caja_id");//Guardamos elemento por id

    if (num_empleado.value == "" || nombre.value == "" || clave.value == "") { //Validamos campos obligatorios
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: 'Faltan Campos Obligatorios' //Mandamos el toster de error por falta de campos obligatorios
        })
    } else if (clave.value != confirmar.value) { //Validamos que las contrasenas sean iguales
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: 'Claves no iguales' //Mandamos mensaje de error por contrasena
        })
    } else {
        const url = base_url + "Usuarios/newUsuario"; //Constante url para controlador
        const frm = document.getElementById("frmUsuario") //Guardamos el formulario
        const http = new XMLHttpRequest(); //htto request metodo
        http.open("POST", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
        http.send(new FormData(frm)); //Mandamos el formulario por el metodo post indicado anteriormente
        http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText); //Imprimimos la respuesta por consola
                const res = JSON.parse(this.responseText); //Guardamos la respuesta en una constante
                if (res == "ok") { //Evaluamos la respuesta de la peticion
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Usuario Registrado' //Mandamos mensaje de usuario registrado
                    })

                    frm.reset(); //Reiniciamos el formulario
                    $("#nuevo_usuario").modal("hide"); //Cerramos el modal de nuevo usuario
                    tblUsuarios.ajax.reload(); //Recargamos tabla usuarios
                } else if (res == "modificado") { //Si el usuario fue actualizado
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Usuario Modificado' //Mandamos mensaje de usuario modificado
                    })

                    tblUsuarios.ajax.reload(); //Recargamos tabla usuarios
                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: res //Mandamos el mensaje de error retornado de la peticion
                    })
                }
            }
        }

    }
}

function btnEliminarUser(id) { //Creamos la funcion Eliminar usuario
    console.log('Eliminar Usuario');

    Swal.fire({
        title: 'Eliminar Usuario',
        text: "El usuario solo se pondra inactivo",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Contirmar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Usuarios/deleteUser/" + id; //Constante url para controlador
            const http = new XMLHttpRequest(); //htto request metodo
            http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
            http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
            http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
                if (this.readyState == 4 && this.status == 200) {

                    const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

                    if (res == "ok") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: "Usuario Eliminado" //Mandamos el mensaje de error retornado de la peticion
                        })

                        tblUsuarios.ajax.reload();
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: res //Mandamos el mensaje de error retornado de la peticion
                        })
                    }
                }
            }

        }
    })
}

function btnReingresarUser(id) { //Creamos la funcion Reingresar usuario
    Swal.fire({
        title: 'Reingresar Usuairo',
        text: "EL usuario se pondra Activo",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Contirmar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Usuarios/reenterUser/" + id; //Constante url para controlador
            const http = new XMLHttpRequest(); //htto request metodo
            http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
            http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
            http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
                if (this.readyState == 4 && this.status == 200) {

                    const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

                    if (res == "ok") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: "Usuario Reingresado" //Retornamos el Mensaje de usuario Reingresaro correctamente
                        })

                        tblUsuarios.ajax.reload();
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: res //Mandamos el mensaje de error retornado de la peticion
                        })
                    }
                }
            }

        }
    })
}

function cerrarModalUsuario() { //----------------------Funcion Cerrar Modal------------------------//
    document.getElementById("frmUsuario").reset(); //Resetear Formulario al cerral el modal
    document.getElementById('num_empleado').readOnly = false;
    document.getElementById("id_empleado").value = "";
}
//=============================================================== SISTEMA DE VENTAS CONTROLLER==========================================================//
//======================================================================================================================================================//


//============================================================== CLIENTES CONTROLLER==========================================================//
//======================================================================================================================================================//
let tblClientes; //Creamos la constante de la tabla Clientes
document.addEventListener('DOMContentLoaded', function () {
    tblClientes = $('#tblClientes').DataTable({ //Declaramos el Id de la tabla
        ajax: {
            url: base_url + "Clientes/listar", //Mandamos a llamar al metodo listar del controlador
            dataSrc: '',
        },
        columns: [
            {
                'data': 'id', //Obtenemos el dato
            },
            {
                'data': 'ine', //Obtenemos el dato
            },
            {
                'data': 'nombre', //Obtenemos el dato
            },
            {
                'data': 'direccion', //Obtenemos el dato
            },
            {
                'data' : 'telefono', //Traemos el dato
            },
            {
                'data' : 'activo', // Traemos el dato
            },
            {
                'data' : 'acciones' //Traemos el dato
            },
        ],
        dom: 'lBfrtip', "responsive": true, "lengthChange": true, "autoWidth": false,
        buttons: [
            'copy',
            'excel',
            {
                extend: 'print',
                text: 'Print',
                title: 'LISTA DE CLIENTES',
                footer: false,
                customize: function (win) {
                    $(win.document.body)
                        .css('font-size', '10pt')
                        .prepend(
                            '<img src="' + base_url + 'Assets/img/Telecel logo.svg' + '" style="position:absolute; top:0; right:0;" />',
                        );
                    $(win.document.body)
                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            },
            {
                extend: 'colvis',
                text:'Visualizar',
            }
        ],
    });
});

function registrarCliente(e) { //Creamos la funcion para registrar o editar cliente
    e.preventDefault(); //Creamos el prevent defaul para evitar la recarga de la pagina
    const ine = document.getElementById("ine"); //Guardamos elemento por id
    const nombre_cliente = document.getElementById("nombre_cliente");//Guardamos elemento por id
    const telefono_cliente = document.getElementById("telefono_cliente");//Guardamos elemento por id
    const direccion_cliente = document.getElementById("direccion_cliente");//Guardamos elemento por id

    if (ine.value == "" || nombre_cliente.value == "" || telefono_cliente.value == "" || direccion_cliente.value == "") { //Validamos campos obligatorios
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: 'Faltan Campos Obligatorios' //Mandamos el toster de error por falta de campos obligatorios
        })
    }else {
        const url = base_url + "Clientes/newCliente"; //Constante url para controlador
        const frm = document.getElementById("frmCliente") //Guardamos el formulario
        const http = new XMLHttpRequest(); //htto request metodo
        http.open("POST", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
        http.send(new FormData(frm)); //Mandamos el formulario por el metodo post indicado anteriormente
        http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText); //Imprimimos la respuesta por consola
                const res = JSON.parse(this.responseText); //Guardamos la respuesta en una constante
                if (res == "ok") { //Evaluamos la respuesta de la peticion
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Cliente Registrado' //Mandamos mensaje de usuario registrado
                    })

                    frm.reset(); //Reiniciamos el formulario
                    $("#nuevo_cliente").modal("hide"); //Cerramos el modal de nuevo usuario
                    tblClientes.ajax.reload(); //Recargamos tabla usuarios
                } else if (res == "modificado") { //Si el usuario fue actualizado
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Cliente Modificado' //Mandamos mensaje de usuario modificado
                    })

                    tblClientes.ajax.reload(); //Recargamos tabla usuarios
                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: res //Mandamos el mensaje de error retornado de la peticion
                    })
                }
            }
        }

    }
}

function btnEditarCliente(id) { //Creamos la funcion para abrir modal con id para registrar usuario 
    document.getElementById("title_nuevo_cliente").innerHTML = "Actualizar Cliente";
    document.getElementById("btn_nuevo_cliente").innerHTML = "Update";
    const url = base_url + "Clientes/editCliente/" + id; //Constante url para controlador
    const http = new XMLHttpRequest(); //htto request metodo
    http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
    http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
    http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
        if (this.readyState == 4 && this.status == 200) {

            const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

            document.getElementById('id_cliente').value = res.id; //Guardamos el id del usuario a editar
            document.getElementById('ine').value = res.ine;
            document.getElementById('nombre_cliente').value = res.nombre;//Guardamos la variable obtenida de la peticion
            document.getElementById('telefono_cliente').value = res.telefono;//Guardamos la variable obtenida de la peticion
            document.getElementById('direccion_cliente').value = res.direccion;//Guardamos la variable obtenida de la peticion
        }
    }

    $('#nuevo_cliente').modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#nuevo_cliente").modal("show"); //Abrimos el modal con la clase estatico
}

function frmClientes() { //Creamos la funcion para abrir le modal para nuevo Cliente
    document.getElementById("title_nuevo_cliente").innerHTML = "Nuevo Cliente"; //Cambiamos el titulo
    document.getElementById("btn_nuevo_cliente").innerHTML = "Save"; //Cambiamos el texto del btn
    $('#nuevo_cliente').modal({ //Le damos las propiedades necesarias al modal para que no cierre
        backdrop: 'static',
        keyboard: false
    });
    $("#nuevo_cliente").modal("show"); //Mostramos el Modale
}

function btnEliminarCliente(id) { //Creamos la funcion Eliminar cliente
    Swal.fire({
        title: 'Eliminar Cliente',
        text: "El cliente solo se pondra inactivo",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Contirmar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Clientes/deleteCliente/" + id; //Constante url para controlador
            const http = new XMLHttpRequest(); //htto request metodo
            http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
            http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
            http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
                if (this.readyState == 4 && this.status == 200) {

                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

                    if (res == "ok") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: "Cliente Eliminado" //Mandamos el mensaje de error retornado de la peticion
                        })

                        tblClientes.ajax.reload();
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: res //Mandamos el mensaje de error retornado de la peticion
                        })
                    }
                }
            }

        }
    })
}

function btnReingresarCliente(id) { //Creamos la funcion Reingresar cliente
    Swal.fire({
        title: 'Reingresar Cliente',
        text: "El cliente se pondra Activo",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Contirmar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Clientes/reenterCliente/" + id; //Constante url para controlador
            const http = new XMLHttpRequest(); //htto request metodo
            http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
            http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
            http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
                if (this.readyState == 4 && this.status == 200) {

                    const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

                    if (res == "ok") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: "Cliente Reingresado" //Retornamos el Mensaje de usuario Reingresaro correctamente
                        })

                        tblClientes.ajax.reload();
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: res //Mandamos el mensaje de error retornado de la peticion
                        })
                    }
                }
            }

        }
    })
}

function cerrarModalCliente() { //----------------------Funcion Cerrar Modal------------------------//
    document.getElementById("frmCliente").reset(); //Resetear Formulario al cerral el modal
    document.getElementById("id_cliente").value = "";
}
//======================================================================= CLIENTES CONTROLLER==========================================================//
//======================================================================================================================================================//

//======================================================================================================================================================//
//======================================================================= CATALOGOS CONTROLLER==========================================================//


//***********************************CAJAS**************************************** */
let tblCaja; //Creamos la constante de la tabla Cajas
document.addEventListener('DOMContentLoaded', function () {
    tblCaja = $('#tblCaja').DataTable({ //Declaramos el Id de la tabla
        ajax: {
            url: base_url + "Catalogos/listar_cajas", //Mandamos a llamar al metodo listar del controlador
            dataSrc: '',
        },
        columns: [
            {
                'data': 'caja', //Obtenemos el dato
            },
            {
                'data' : 'activo', // Traemos el dato
            },
            {
                'data' : 'acciones' //Traemos el dato
            },
        ],
         "responsive": true, "lengthChange": true,
    });
});

function registrarCaja(e) { //Creamos la funcion para registrar o editar Caja
    e.preventDefault(); //Creamos el prevent defaul para evitar la recarga de la pagina
    const nombre_caja = document.getElementById("nombre_caja");//Guardamos elemento por id

    if (nombre_caja.value == "") { //Validamos campos obligatorios
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: 'Faltan Campos Obligatorios' //Mandamos el toster de error por falta de campos obligatorios
        })
    }else {
        const url = base_url + "Catalogos/newCaja"; //Constante url para controlador
        const frm = document.getElementById("frmCaja") //Guardamos el formulario
        const http = new XMLHttpRequest(); //htto request metodo
        http.open("POST", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
        http.send(new FormData(frm)); //Mandamos el formulario por el metodo post indicado anteriormente
        http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText); //Imprimimos la respuesta por consola
                const res = JSON.parse(this.responseText); //Guardamos la respuesta en una constante
                if (res == "ok") { //Evaluamos la respuesta de la peticion
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Caja Registrada' //Mandamos mensaje de caja registrado
                    })

                    frm.reset(); //Reiniciamos el formulario
                    $("#nuevo_caja").modal("hide"); //Cerramos el modal de nuevo usuario
                    tblCaja.ajax.reload(); //Recargamos tabla usuarios
                } else if (res == "modificado") { //Si el usuario fue actualizado
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Caja Modificada' //Mandamos mensaje de usuario modificado
                    })

                    tblCaja.ajax.reload(); //Recargamos tabla usuarios
                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: res //Mandamos el mensaje de error retornado de la peticion
                    })
                }
            }
        }

    }
}

function btnEditarCaja(id) { //Creamos la funcion para abrir modal con id para registrar Caja 
    document.getElementById("title_caja").innerHTML = "Actualizar Caja";
    document.getElementById("btnAccion_caja").innerHTML = "Update";
    const url = base_url + "Catalogos/editCaja/" + id; //Constante url para controlador
    const http = new XMLHttpRequest(); //htto request metodo
    http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
    http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
    http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
        if (this.readyState == 4 && this.status == 200) {

            const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

            document.getElementById('id_caja').value = res.id; //Guardamos el id del usuario a editar
            document.getElementById('nombre_caja').value = res.caja;//Guardamos la variable obtenida de la peticion
        }
    }

    $('#nuevo_caja').modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#nuevo_caja").modal("show"); //Abrimos el modal con la clase estatico
}

function frmCaja() { //Creamos la funcion para abrir le modal para nuevo Caja
    document.getElementById("title_caja").innerHTML = "Nuevo Caja"; //Cambiamos el titulo
    document.getElementById("btnAccion_caja").innerHTML = "Save"; //Cambiamos el texto del btn
    $('#nuevo_caja').modal({ //Le damos las propiedades necesarias al modal para que no cierre
        backdrop: 'static',
        keyboard: false
    });
    $("#nuevo_caja").modal("show"); //Mostramos el Modale
}

function btnEliminarCaja(id) { //Creamos la funcion Eliminar Caja
    Swal.fire({
        title: 'Eliminar Caja',
        text: "La Caja solo se pondra inactivo",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Contirmar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Catalogos/deleteCaja/" + id; //Constante url para controlador
            const http = new XMLHttpRequest(); //htto request metodo
            http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
            http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
            http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
                if (this.readyState == 4 && this.status == 200) {

                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

                    if (res == "ok") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: "Caja Eliminada" //Mandamos el mensaje de error retornado de la peticion
                        })

                        tblCaja.ajax.reload();
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: res //Mandamos el mensaje de error retornado de la peticion
                        })
                    }
                }
            }

        }
    })
}

function btnReingresarCaja(id) { //Creamos la funcion Reingresar Caja
    Swal.fire({
        title: 'Reingresar Caja',
        text: "La Caja se pondra Activo",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Contirmar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Catalogos/reenterCaja/" + id; //Constante url para controlador
            const http = new XMLHttpRequest(); //htto request metodo
            http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
            http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
            http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
                if (this.readyState == 4 && this.status == 200) {

                    const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

                    if (res == "ok") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: "Caja Reingresado" //Retornamos el Mensaje de usuario Reingresaro correctamente
                        })

                        tblCaja.ajax.reload();
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: res //Mandamos el mensaje de error retornado de la peticion
                        })
                    }
                }
            }

        }
    })
}

function cerrarModalCaja() { //----------------------Funcion Cerrar Modal------------------------//
    document.getElementById("frmCaja").reset(); //Resetear Formulario al cerral el modal
    document.getElementById("id_caja").value = "";
}
//***********************************CAJAS**************************************** */



//***********************************CATEGORIA**************************************** */
let tblCategoria; //Creamos la constante de la tabla Clientes
document.addEventListener('DOMContentLoaded', function () {
    tblCategoria = $('#tblCategoria').DataTable({ //Declaramos el Id de la tabla
        ajax: {
            url: base_url + "Catalogos/listar_categorias", //Mandamos a llamar al metodo listar del controlador
            dataSrc: '',
        },
        columns: [
            {
                'data': 'nombre', //Obtenemos el dato
            },
            {
                'data' : 'activo', // Traemos el dato
            },
            {
                'data' : 'acciones' //Traemos el dato
            },
        ],
         "responsive": true, "lengthChange": true,
    });
});

function registrarCategoria(e) { //Creamos la funcion para registrar o editar cliente
    e.preventDefault(); //Creamos el prevent defaul para evitar la recarga de la pagina

    const nombre_categoria = document.getElementById("nombre_categoria");//Guardamos elemento por id

    if (nombre_categoria.value == "") { //Validamos campos obligatorios
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: 'Faltan Campos Obligatorios' //Mandamos el toster de error por falta de campos obligatorios
        })
    }else {
        const url = base_url + "Catalogos/newCategoria"; //Constante url para controlador
        const frm = document.getElementById("frmCategoria") //Guardamos el formulario
        const http = new XMLHttpRequest(); //htto request metodo
        http.open("POST", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
        http.send(new FormData(frm)); //Mandamos el formulario por el metodo post indicado anteriormente
        http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText); //Imprimimos la respuesta por consola
                const res = JSON.parse(this.responseText); //Guardamos la respuesta en una constante
                if (res == "ok") { //Evaluamos la respuesta de la peticion
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Categoria Registrado' //Mandamos mensaje de usuario registrado
                    })

                    frm.reset(); //Reiniciamos el formulario
                    $("#nuevo_categoria").modal("hide"); //Cerramos el modal de nuevo usuario
                    tblCategoria.ajax.reload(); //Recargamos tabla usuarios
                } else if (res == "modificado") { //Si el usuario fue actualizado
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Categoria Modificado' //Mandamos mensaje de usuario modificado
                    })

                    tblCategoria.ajax.reload(); //Recargamos tabla usuarios
                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: res //Mandamos el mensaje de error retornado de la peticion
                    })
                }
            }
        }

    }
}

function btnEditarCategoria(id) { //Creamos la funcion para abrir modal con id para registrar usuario 
    document.getElementById("title_categoria").innerHTML = "Actualizar Categoria";

    document.getElementById("btnAccion_categoria").innerHTML = "Save"; //Cambiamos el texto del btn

    const url = base_url + "Catalogos/editCategoria/" + id; //Constante url para controlador
    const http = new XMLHttpRequest(); //htto request metodo
    http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
    http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
    http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
        if (this.readyState == 4 && this.status == 200) {

            const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

            document.getElementById('id_categoria').value = res.id; //Guardamos el id del usuario a editar
            document.getElementById('nombre_categoria').value = res.nombre;//Guardamos la variable obtenida de la peticion
        }
    }

    $('#nuevo_categoria').modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#nuevo_categoria").modal("show"); //Abrimos el modal con la clase estatico
}

function frmCategoria() { //Creamos la funcion para abrir le modal para nuevo Cliente
    document.getElementById("title_categoria").innerHTML = "Nuevo Categoria"; //Cambiamos el titulo
    document.getElementById("btnAccion_categoria").innerHTML = "Save"; //Cambiamos el texto del btn
    $('#nuevo_categoria').modal({ //Le damos las propiedades necesarias al modal para que no cierre
        backdrop: 'static',
        keyboard: false
    });
    $("#nuevo_categoria").modal("show"); //Mostramos el Modale
}

function btnEliminarCategoria(id) { //Creamos la funcion Eliminar cliente
    Swal.fire({
        title: 'Eliminar Categoria',
        text: "La cateogoria solo se pondra inactivo",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Contirmar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Catalogos/deleteCategoria/" + id; //Constante url para controlador
            const http = new XMLHttpRequest(); //htto request metodo
            http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
            http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
            http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
                if (this.readyState == 4 && this.status == 200) {

                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

                    if (res == "ok") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: "Categoria Eliminado" //Mandamos el mensaje de error retornado de la peticion
                        })

                        tblCategoria.ajax.reload();
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: res //Mandamos el mensaje de error retornado de la peticion
                        })
                    }
                }
            }

        }
    })
}

function btnReingresarCategoria(id) { //Creamos la funcion Reingresar cliente
    Swal.fire({
        title: 'Reingresar Categoria',
        text: "La categoria se pondra Activo",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Contirmar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Catalogos/reenterCategoria/" + id; //Constante url para controlador
            const http = new XMLHttpRequest(); //htto request metodo
            http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
            http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
            http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
                if (this.readyState == 4 && this.status == 200) {

                    const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

                    if (res == "ok") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: "Categoria Reingresado" //Retornamos el Mensaje de usuario Reingresaro correctamente
                        })

                        tblCategoria.ajax.reload();
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: res //Mandamos el mensaje de error retornado de la peticion
                        })
                    }
                }
            }

        }
    })
}

function cerrarModalCategoria() { //----------------------Funcion Cerrar Modal------------------------//
    document.getElementById("frmCategoria").reset(); //Resetear Formulario al cerral el modal
    document.getElementById("id_categoria").value = "";
}
//***********************************CATEGORIA**************************************** */

//***********************************MEDIDAD**************************************** */
let tblMedida; //Creamos la constante de la tabla Clientes
document.addEventListener('DOMContentLoaded', function () {
    tblMedida = $('#tblMedida').DataTable({ //Declaramos el Id de la tabla
        ajax: {
            url: base_url + "Catalogos/listar_medidas", //Mandamos a llamar al metodo listar del controlador
            dataSrc: '',
        },
        columns: [
            {
                'data': 'nombre', //Obtenemos el dato
            },
            {
                'data' : 'activo', // Traemos el dato
            },
            {
                'data' : 'acciones' //Traemos el dato
            },
        ],
         "responsive": true, "lengthChange": true,
    });
});

function registrarMedida(e) { //Creamos la funcion para registrar o editar cliente
    e.preventDefault(); //Creamos el prevent defaul para evitar la recarga de la pagina


    const nombre_medida = document.getElementById("nombre_medida");//Guardamos elemento por id
    const nombre_corto = document.getElementById("nombre_corto");//Guardamos elemento por id

    if (nombre_medida.value == "" || nombre_corto.value == "") { //Validamos campos obligatorios
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: 'Faltan Campos Obligatorios' //Mandamos el toster de error por falta de campos obligatorios
        })
    }else {
        const url = base_url + "Catalogos/newMedida"; //Constante url para controlador
        const frm = document.getElementById("frmMedida") //Guardamos el formulario
        const http = new XMLHttpRequest(); //htto request metodo
        http.open("POST", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
        http.send(new FormData(frm)); //Mandamos el formulario por el metodo post indicado anteriormente
        http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText); //Imprimimos la respuesta por consola
                const res = JSON.parse(this.responseText); //Guardamos la respuesta en una constante
                if (res == "ok") { //Evaluamos la respuesta de la peticion
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Medida Registrado' //Mandamos mensaje de usuario registrado
                    })

                    frm.reset(); //Reiniciamos el formulario
                    $("#nuevo_medida").modal("hide"); //Cerramos el modal de nuevo usuario
                    tblMedida.ajax.reload(); //Recargamos tabla usuarios
                } else if (res == "modificado") { //Si el usuario fue actualizado
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Medida Modificado' //Mandamos mensaje de usuario modificado
                    })

                    tblMedida.ajax.reload(); //Recargamos tabla usuarios
                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: res //Mandamos el mensaje de error retornado de la peticion
                    })
                }
            }
        }

    }
}

function btnEditarMedida(id) { //Creamos la funcion para abrir modal con id para registrar usuario 
    document.getElementById("title_medida").innerHTML = "Actualizar Medida";

    document.getElementById("btnAccion_medida").innerHTML = "Save"; //Cambiamos el texto del btn

    const url = base_url + "Catalogos/editMedida/" + id; //Constante url para controlador
    const http = new XMLHttpRequest(); //htto request metodo
    http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
    http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
    http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
        if (this.readyState == 4 && this.status == 200) {

            const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

            document.getElementById('id_medida').value = res.id; //Guardamos el id del usuario a editar
            document.getElementById('nombre_corto').value = res.nombre_corto;//Guardamos la variable obtenida de la peticion
            document.getElementById('nombre_medida').value = res.nombre;//Guardamos la variable obtenida de la peticion
        }
    }

    $('#nuevo_medida').modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#nuevo_medida").modal("show"); //Abrimos el modal con la clase estatico
}

function frmMedida() { //Creamos la funcion para abrir le modal para nuevo Cliente
    document.getElementById("title_medida").innerHTML = "Nuevo Medida"; //Cambiamos el titulo
    document.getElementById("btnAccion_medida").innerHTML = "Save"; //Cambiamos el texto del btn
    $('#nuevo_medida').modal({ //Le damos las propiedades necesarias al modal para que no cierre
        backdrop: 'static',
        keyboard: false
    });
    $("#nuevo_medida").modal("show"); //Mostramos el Modale
}

function btnEliminarMedida(id) { //Creamos la funcion Eliminar cliente
    Swal.fire({
        title: 'Eliminar Medida',
        text: "La medida solo se pondra inactivo",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Contirmar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Catalogos/deleteMedida/" + id; //Constante url para controlador
            const http = new XMLHttpRequest(); //htto request metodo
            http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
            http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
            http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
                if (this.readyState == 4 && this.status == 200) {

                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

                    if (res == "ok") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: "Medida Eliminado" //Mandamos el mensaje de error retornado de la peticion
                        })

                        tblMedida.ajax.reload();
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: res //Mandamos el mensaje de error retornado de la peticion
                        })
                    }
                }
            }

        }
    })
}

function btnReingresarMedida(id) { //Creamos la funcion Reingresar cliente
    Swal.fire({
        title: 'Reingresar Medida',
        text: "La medida se pondra Activo",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Contirmar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Catalogos/reenterMedida/" + id; //Constante url para controlador
            const http = new XMLHttpRequest(); //htto request metodo
            http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
            http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
            http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
                if (this.readyState == 4 && this.status == 200) {

                    const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

                    if (res == "ok") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: "Medida Reingresado" //Retornamos el Mensaje de usuario Reingresaro correctamente
                        })

                        tblMedida.ajax.reload();
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: res //Mandamos el mensaje de error retornado de la peticion
                        })
                    }
                }
            }

        }
    })
}

function cerrarModalMedida() { //----------------------Funcion Cerrar Modal------------------------//
    document.getElementById("frmMedida").reset(); //Resetear Formulario al cerral el modal
    document.getElementById("id_medida").value = "";
}
//***********************************MEDIDAD**************************************** */
//======================================================================= CATALOGOS CONTROLLER==========================================================//
//======================================================================================================================================================//

//======================================================================================================================================================//
//======================================================================= PRODUCTOS CONTROLLER==========================================================//
let tblProductos; //Creamos la constante de la tabla Usuarios
document.addEventListener('DOMContentLoaded', function () {
    tblProductos = $('#tblProductos').DataTable({ //Declaramos el Id de la tabla
        ajax: {
            url: base_url + "Productos/listar", //Mandamos a llamar al metodo listar del controlador
            dataSrc: '',
        },
        columns: [
            {
                'data': 'codigo', //Obtenemos el dato
            },
            {
                'data': 'descripcion', //Obtenemos el dato
            },
            {
                'data': 'precio_compra', render: $.fn.dataTable.render.number(',', '.', 2, '$'), //Obtenemos el dato
            },
            {
                'data': 'precio_venta', render: $.fn.dataTable.render.number(',', '.', 2, '$'), //Obtenemos el dato
            },
            {
                'data': 'cantidad',
            },
            {
                'data': 'nombre_medida'
            },
            {
                'data': 'nombre_categoria'
            },
            {
                'data': 'activo'
            },
            {
                'data': 'acciones'
            },
        ],
        dom: 'lBfrtip', "responsive": true, "lengthChange": true, "autoWidth": false,
        buttons: [
            'copy',
            'excel',
            {
                extend: 'print',
                text: 'Print',
                title: 'LISTA DE USUARIOS',
                footer: false,
                customize: function (win) {
                    $(win.document.body)
                        .css('font-size', '10pt')
                        .prepend(
                            '<img src="' + base_url + 'Assets/img/Telecel logo.svg' + '" style="position:absolute; top:0; right:0;" />',
                        );
                    $(win.document.body)
                        .append('<div style=" margin-top: 50px;text-align: center;margin-left: 250px;">' +
                            '<div style="float:left;margin-right:100px;">' + '<p>Gerente OYM Telcel R3</p>' +
                            '<div style="border-top: 1px solid black;height: 2px;max-width: 200px;padding: 0;margin: 50px auto 0 auto;">' +
                            '<p>ING.MIGUEL ANGEL GARCIA SOTO</p>'
                            + '</div>'
                            + '</div>' +
                            '<div style="display: table-cell;">' + '<p>Solicito Reporte</p>' +
                            '<div style="border-top: 1px solid black;height: 2px;max-width: 200px;padding: 0;margin: 50px auto 0 auto;">' +
                            '<p>ING.' + 'ALBERTO SANCHEZ ORTIZ' + '</p >'
                            + '</div>'
                            + '</div>'
                            + '</div>'
                        ); //after the table
                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            },
            {
                extend: 'colvis',
                text: 'Visualizar',
            }
        ],
    });
});

function frmProducto() { //Creamos la funcion para abrir le modal para nuevo Producto
    document.getElementById("title_nuevo_producto").innerHTML = "Nuevo Producto";
    document.getElementById("btn_nuevo_producto").innerHTML = "Save";
    $('#nuevo_producto').modal({ //Le damos las propiedades necesarias al modal para que no cierre
        backdrop: 'static',
        keyboard: false
    });
    $("#nuevo_producto").modal("show"); //Mostramos el Modale
}

function registrarProducto(e) { //Creamos la funcion para registrar o editar producto
    e.preventDefault(); //Creamos el prevent defaul para evitar la recarga de la pagina
    const codigo = document.getElementById("codigo"); //Guardamos elemento por id
    const descripcion = document.getElementById("descripcion");//Guardamos elemento por id
    const precio_compra = document.getElementById("precio_compra");//Guardamos elemento por id
    const precio_venta = document.getElementById("precio_venta");//Guardamos elemento por id
    const cantidad = document.getElementById("cantidad");//Guardamos elemento por id
    const id_medida = document.getElementById("id_medida");//Guardamos elemento por id
    const id_categoria = document.getElementById("id_categoria");//Guardamos elemento por id

    if (codigo.value == "" || descripcion.value == "" || precio_compra.value == "" || precio_venta.value == "" || cantidad.value == "") { //Validamos campos obligatorios
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: 'Faltan Campos Obligatorios' //Mandamos el toster de error por falta de campos obligatorios
        })
    }  else {
        const url = base_url + "Productos/newProducto"; //Constante url para controlador
        const frm = document.getElementById("frmProductos") //Guardamos el formulario
        const http = new XMLHttpRequest(); //htto request metodo
        http.open("POST", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
        http.send(new FormData(frm)); //Mandamos el formulario por el metodo post indicado anteriormente
        http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText); //Imprimimos la respuesta por consola
                const res = JSON.parse(this.responseText); //Guardamos la respuesta en una constante
                if (res == "ok") { //Evaluamos la respuesta de la peticion
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Producto Registrado' //Mandamos mensaje de producto registrado
                    })

                    frm.reset(); //Reiniciamos el formulario
                    $("#nuevo_producto").modal("hide"); //Cerramos el modal de nuevo producto
                    tblProductos.ajax.reload(); //Recargamos tabla productos
                } else if (res == "modificado") { //Si el producto fue actualizado
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Producto Modificado' //Mandamos mensaje de producto modificado
                    })

                    tblProductos.ajax.reload(); //Recargamos tabla productos
                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: res //Mandamos el mensaje de error retornado de la peticion
                    })
                }
            }
        }

    }
}

function btnEditarProducto(id) { //Creamos la funcion para abrir modal con id para registrar usuario 
    document.getElementById("title_nuevo_producto").innerHTML = "Actualizar Producto";
    document.getElementById("btn_nuevo_producto").innerHTML = "Update";
    const url = base_url + "Productos/editProducto/" + id; //Constante url para controlador
    const http = new XMLHttpRequest(); //htto request metodo
    http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
    http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
    http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
        if (this.readyState == 4 && this.status == 200) {

            const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

            document.getElementById('id_producto').value = res.id; //Guardamos el id del usuario a editar
            document.getElementById('codigo').value = res.codigo;
            document.getElementById('descripcion').value = res.descripcion;//Guardamos la variable obtenida de la peticion
            document.getElementById('id_categoria').value = res.id_categoria;//Guardamos la variable obtenida de la peticion
            document.getElementById('id_medida').value = res.id_medida; //Guardamos la variable obtenida de la peticion
            document.getElementById('cantidad').value = res.cantidad;//Guardamos la variable obtenida de la peticion
            document.getElementById('precio_compra').value = res.precio_compra;//Guardamos la variable obtenida de la peticion
            document.getElementById('precio_venta').value = res.precio_venta;//Guardamos la variable obtenida de la peticion
        }
    }

    $('#nuevo_producto').modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#nuevo_producto").modal("show"); //Abrimos el modal con la clase estatico
}

function btnEliminarProducto(id) { //Creamos la funcion Eliminar producto

    Swal.fire({
        title: 'Eliminar Producto',
        text: "El producto solo se pondra inactivo",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Contirmar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Productos/deleteProducto/" + id; //Constante url para controlador
            const http = new XMLHttpRequest(); //htto request metodo
            http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
            http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
            http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
                if (this.readyState == 4 && this.status == 200) {

                    console.log(this.responseText);

                    const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

                    if (res == "ok") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: "Producto Eliminado" //Mandamos el mensaje de error retornado de la peticion
                        })

                        tblProductos.ajax.reload();
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: res //Mandamos el mensaje de error retornado de la peticion
                        })
                    }
                }
            }

        }
    })
}

function btnReingresarProducto(id) { //Creamos la funcion Reingresar usuario
    Swal.fire({
        title: 'Reingresar Producto',
        text: "EL producto se pondra Activo",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Contirmar'
    }).then((result) => {
        if (result.isConfirmed) {

            const url = base_url + "Productos/reenterProducto/" + id; //Constante url para controlador
            const http = new XMLHttpRequest(); //htto request metodo
            http.open("GET", url, true); //Utilizamos una peticion post, al url creado y indicamos que es async
            http.send(); //Mandamos el formulario por el metodo post indicado anteriormente
            http.onreadystatechange = function () { //Creamos la funcion onredy cuando se termine
                if (this.readyState == 4 && this.status == 200) {

                    const res = JSON.parse(this.responseText); //Imporimomos en consola la respuesta

                    if (res == "ok") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: "Producto Reingresado" //Retornamos el Mensaje de usuario Reingresaro correctamente
                        })

                        tblProductos.ajax.reload();
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: res //Mandamos el mensaje de error retornado de la peticion
                        })
                    }
                }
            }

        }
    })
}

function cerrarModalProducto() { //----------------------Funcion Cerrar Modal------------------------//
    document.getElementById("frmProductos").reset(); //Resetear Formulario al cerral el modal
    document.getElementById("id_producto").value = "";
}
//======================================================================= PRODUCTOS CONTROLLER==========================================================//
//======================================================================================================================================================//