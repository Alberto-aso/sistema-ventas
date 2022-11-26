<?php

class Usuarios extends Controller
{ //Creamos la classe Usuarios
    public function __construct() //cargar el constructor de la instancia del modelo
    {
        session_start(); //Abrimos la session de la aplicacion la cual guardara informacion vital para el funcionamiento

        parent::__construct();
    }
    public function index()
    {
        if (empty($_SESSION['activo_sistema_ventas'])) { //Evaluamos si el usuairo ya esta autenticado
            header("location: " . base_url);
        }
        $data['cajas'] = $this->model->getCajas();
        $this->views->getView($this, "index", $data); //Cargamois la vista de Usuarios
    }

    public function listar()
    { //Generamos el metodo listar
        $data = $this->model->getUsuarios(); //obtenemos la consulta del metodo getUsuarios
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) { //Evaluamos si el usuario esta activo
                $data[$i]['activo'] = '<span style="color: green;">Activo</span>'; //Agregamos la clase green para Activo

                $data[$i]['acciones'] = '<div>
                        <button type="button" class="btn btn-primary btn-sm" onclick="btnEditarUser(' . $data[$i]['id'] . ');" title="Editar"">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="btnEliminarUser(' . $data[$i]['id'] . ');" title="Eliminar"">
                            <i class="fas fa-trash-alt">
                        </i></button>'; //Añadimos los button a cada uno de los registros

            } else {
                $data[$i]['activo'] = '<span style="color: red;">Inactivo</span>'; //Agregamos la clase red para No Activo

                $data[$i]['acciones'] = '<div>
                         <button type="button" class="btn btn-success btn-sm" onclick="btnReingresarUser(' . $data[$i]['id'] . ');" title="Reingresar"">
                <i class="fas fa-sign-in-alt"></i></i>
                        </button>'; //Añadimos los button a cada uno de los registros

            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE); //Retornamos la respuesta
        die();
    }

    public function validar()
    { //Creamos la funcion validar 
        if (empty($_POST['usuario'] || empty($_POST['clave']))) { //Verificar campos obligatorios
            $msg = "Faltan campos Oblogatorios"; //Mandamos el mensaje de campos vacios
        } else {
            $usuario = $_POST['usuario']; //Guardamos lo que contenga el input
            $clave = $_POST['clave']; //Guardamos lo que contenga el campo

            $clave_encriptada = hash("SHA256", $clave);

            $data = $this->model->getUsuario($usuario, $clave_encriptada); //Mandamos a ejecutar la funcion getUsuario del Modelo

            if ($data) {
                $_SESSION['id_usuario_sistema_ventas'] = $data['id']; //Guardamos en la session la informacion de la peticio
                $_SESSION['num_empleado_sistema_ventas'] = $data['num_empleado']; //Guardamos en test session la informacion de la ijshfh
                $_SESSION['nombre_usuario_sistema_ventas'] = $data['nombre']; //Guardamos en test session la informacion the la peticion
                $_SESSION['activo_sistema_ventas'] = true;
                $msg = "ok"; //Retornamos el mensaje de peticion correcta
            } else {
                $msg = "Usuario o Clave Incorrecta"; //Retornamos mensaje de peticion test
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE); //Regresamos la respuesta como un json
        die(); //retoramos la funcion die
    }

    public function newUsuario()
    { //Creamos la funcion para registrar usuario o editar
        $id_empleado = $_POST['id_empleado']; //Guardamos el id del usuario a actrualizar
        $num_empleado = $_POST['num_empleado']; //Guardamos campo de la peticion POST
        $nombre = $_POST['nombre']; //Guardamos campo de la peticion POST
        $clave = $_POST['clave']; //Guardamos campo de la peticion POST
        $confirmar = $_POST['confirmar']; //Guardamos campo de la peticion POST
        $caja_id = $_POST['caja_id']; //Guardamos campo de la peticion POST

        $clave_encriptada = hash("SHA256", $clave); //encriptamos la contrasena del usuario

        if (empty($num_empleado) || empty($nombre) || empty($clave)) { //Validamos que los campos esten completos
            $msg = "Faltam campos Obligatorios"; //Mensaje de error
        } else {
            if ($id_empleado == "") { //evaluamos el el id del usuairo no es vacio para acutalizarlo o e snuevo

                if ($clave != $confirmar) {
                    $msg = "Claves no Iguales"; //Mensaje de error
                } else {
                    $data = $this->model->postUsuario($num_empleado, $nombre, $clave_encriptada, $caja_id); //Mandamos al metodo registrar nuevo usuario

                    if ($data == "ok") { //Evaluamos la respuesta de el INSERT o UPDATE
                        $msg = "ok";
                    } else if ($data == "existe") { //Mandamos error de que ya existe el usuario
                        $msg = "Usuario ya Registrado";
                    } else {
                        $msg = "Error al registrar usuario"; //Mendaje de error al insertar datos
                    }
                }
            } else {

                $data = $this->model->updateUsuario($num_empleado, $nombre, $caja_id, $id_empleado); //Mandamos a llamar al metodo update del modelo

                if ($data == "modificado") { //Mandamos la respuesta d emodificado
                    $msg = "modificado";
                } else {
                    $msg = "Error al modificar usuario"; //Mandamos mensaje de error al actualizar usuario
                }
            }
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE); //Retornamos el mensaje obtenido de la peticion 
        die();
    }

    public function editUser(int $id)
    { //Creamos la funcion para traer la informacion de un solo usuario
        $data = $this->model->getOneUser($id); //Mandamos la peticion al modelo y la guardamos en una variable
        echo json_encode($data, JSON_UNESCAPED_UNICODE); //Retornamos la respuesta
        die();
    }

    public function deleteUser(int $id) //Funcion Eliminar Usuario
    {

        $data = $this->model->actionUser(0, $id); //Madamos el estado 0 a la funcion de ActionUser

        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al Eliminar Usuario";
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reenterUser(int $id) //Funcion Reingresar Usuario
    {
        $data = $this->model->actionUser(1, $id); //Madamos el estado 1 a la funcion de ActionUser

        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al Reingresar Usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function salir() //Funcion Salid e la aplicacion
    {
        //session_destroy(); Elimina todas las variables de la session incluyendo las de las demas aplicaciones 
        unset($_SESSION['activo_sistema_ventas']);
        header("location: " . base_url);
    }
}
