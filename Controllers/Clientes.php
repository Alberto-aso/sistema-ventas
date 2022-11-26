<?php

class Clientes extends Controller
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
        $this->views->getView($this, "index"); //Cargamois la vista de Usuarios
    }

    public function listar()
    { //Generamos el metodo listar
        $data = $this->model->getClientes(); //obtenemos la consulta del metodo getClientes
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) { //Evaluamos si el usuario esta activo
                $data[$i]['activo'] = '<span style="color: green;">Activo</span>'; //Agregamos la clase green para Activo
                $data[$i]['acciones'] = '<div>
                <button type="button" class="btn btn-primary btn-sm" onclick="btnEditarCliente(' . $data[$i]['id'] . ');" title="Editar"">
                <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button type="button" class="btn btn-danger btn-sm" onclick="btnEliminarCliente(' . $data[$i]['id'] . ');" title="Eliminar"">
                <i class="fas fa-trash-alt">
                </i></button>'; //Añadimos los button a cada uno de los registros
            } else {
                $data[$i]['activo'] = '<span style="color: red;">Inactivo</span>'; //Agregamos la clase red para No Activo
                $data[$i]['acciones'] = '<div>
                <button type="button" class="btn btn-success btn-sm" onclick="btnReingresarCliente(' . $data[$i]['id'] . ');" title="Reingresar"">
                <i class="fas fa-sign-in-alt"></i></i>
                </button>'; //Añadimos los button a cada uno de los registros
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE); //Retornamos la respuesta
        die();
    }

    public function newCliente()
    { //Creamos la funcion para registrar usuario o editar
        $id_cliente = $_POST['id_cliente']; //Guardamos el id del cliente a actrualizar
        $ine = $_POST['ine']; //Guardamos campo de la peticion POST
        $nombre = $_POST['nombre_cliente']; //Guardamos campo de la peticion POST
        $telefono = $_POST['telefono_cliente']; //Guardamos campo de la peticion POST
        $direccion = $_POST['direccion_cliente']; //Guardamos campo de la peticion POST

        if (empty($ine) || empty($nombre) || empty($telefono) || empty($direccion)) { //Validamos que los campos esten completos
            $msg = "Faltam campos Obligatorios"; //Mensaje de error
        } else {
            if ($id_cliente == "") { //evaluamos el el id del usuairoienteno es vacio para acutalizarlo o e snuevo

                $data = $this->model->postCliente($ine, $nombre, $telefono, $direccion); //Mandamos al metodo registrar nuevo cliente

                if ($data == "ok") { //Evaluamos la respuesta de el INSERT o UPDATE
                    $msg = "ok";
                } else if ($data == "existe") { //Mandamos error de que ya existe el cliente
                    $msg = "Cliente ya Registrado";
                } else {
                    $msg = "Error al registrar cliente"; //Mendaje de error al insertar datos
                }
            } else {

                $data = $this->model->updateCliente($ine, $nombre, $telefono, $direccion, $id_cliente); //Mandamos a llamar al metodo update del modelo

                if ($data == "modificado") { //Mandamos la respuesta d emodificado
                    $msg = "modificado";
                } else {
                    $msg = "Error al modificar cliente"; //Mandamos mensaje de error al actualizar usuario
                }
            }
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE); //Retornamos el mensaje obtenido de la peticion 
        die();
    }

    public function editCliente(int $id)
    { //Creamos la funcion para traer la informacion de un solo cliente
        $data = $this->model->getOneCliente($id); //Mandamos la peticion al modelo y la guardamos en una variable
        echo json_encode($data, JSON_UNESCAPED_UNICODE); //Retornamos la respuesta
        die();
    }

    public function deleteCliente(int $id) //Funcion Eliminar Usuario
    {
        $data = $this->model->actionCliente(0, $id); //Madamos el estado 0 a la funcion de ActionCliente

        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al Eliminar Cliente";
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reenterCliente(int $id) //Funcion Reingresar Usuario
    {
        $data = $this->model->actionCliente(1, $id); //Madamos el estado 1 a la funcion de ActionCliente

        if ($data == 1) {
            $msg = "ok"; //Retornamos el mensaje que la peticion se ejecutor correctamenre
        } else {
            $msg = "Error al Reingresar Usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
