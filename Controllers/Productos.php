<?php

class Productos extends Controller
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
        $data['categorias'] = $this->model->getCategorias();
        $data['medidad'] = $this->model->getMedidas();
        $this->views->getView($this, "index", $data); //Cargamois la vista de Usuarios
    }

    public function listar()
    { //Generamos el metodo listar
        $data = $this->model->getProductos(); //obtenemos la consulta del metodo getUsuarios
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) { //Evaluamos si el usuario esta activo
                $data[$i]['activo'] = '<span style="color: green;">Activo</span>'; //Agregamos la clase green para Activo

                $data[$i]['acciones'] = '<div>
                        <button type="button" class="btn btn-primary btn-sm" onclick="btnEditarProducto(' . $data[$i]['id'] . ');" title="Editar"">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="btnEliminarProducto(' . $data[$i]['id'] . ');" title="Eliminar"">
                            <i class="fas fa-trash-alt">
                        </i></button>'; //Añadimos los button a cada uno de los registros

            } else {
                $data[$i]['activo'] = '<span style="color: red;">Inactivo</span>'; //Agregamos la clase red para No Activo

                $data[$i]['acciones'] = '<div>
                         <button type="button" class="btn btn-success btn-sm" onclick="btnReingresarProducto(' . $data[$i]['id'] . ');" title="Reingresar"">
                <i class="fas fa-sign-in-alt"></i></i>
                        </button>'; //Añadimos los button a cada uno de los registros
            }
       }
        echo json_encode($data, JSON_UNESCAPED_UNICODE); //Retornamos la respuesta
        die();
    }


    public function newProducto()
    { //Creamos la funcion para registrar usuario o editar
        $id_producto = $_POST['id_producto']; //Guardamos el id del usuario a actrualizar
        $codigo = $_POST['codigo']; //Guardamos campo de la peticion POST
        $descripcion = $_POST['descripcion']; //Guardamos campo de la peticion POST
        $precio_compra = $_POST['precio_compra']; //Guardamos campo de la peticion POST
        $precio_venta = $_POST['precio_venta']; //Guardamos campo de la peticion POST
        $medida_id = $_POST['id_medida']; //Guardamos campo de la peticion POST
        $categoria_id = $_POST['id_categoria'];
        $cantidad = $_POST['cantidad'];

        if (empty($codigo) || empty($descripcion)) { //Validamos que los campos esten completos
            $msg = "Faltam campos Obligatorios"; //Mensaje de error
        } else {
            if ($id_producto == "") { //evaluamos el el id del usuairo no es vacio para acutalizarlo o e snuevo

                $data = $this->model->postProducto($codigo, $descripcion, $precio_compra, $precio_venta, $medida_id, $categoria_id, $cantidad); //Mandamos al metodo registrar nuevo usuario

                if ($data == "ok") { //Evaluamos la respuesta de el INSERT o UPDATE
                    $msg = "ok";
                } else if ($data == "existe") { //Mandamos error de que ya existe el usuario
                    $msg = "PRoducto ya Registrado";
                } else {
                    $msg = "Error al registrar producto"; //Mendaje de error al insertar datos
                }
            } else {

                $data = $this->model->updateProducto($codigo, $descripcion, $precio_compra, $precio_venta, $medida_id, $categoria_id, $cantidad, $id_producto); //Mandamos a llamar al metodo update del modelo

                if ($data == "modificado") { //Mandamos la respuesta d emodificado
                    $msg = "modificado";
                } else {
                    $msg = "Error al modificar producto"; //Mandamos mensaje de error al actualizar usuario
                }
            }
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE); //Retornamos el mensaje obtenido de la peticion 
        die();
    }

    public function editProducto(int $id)
    { //Creamos la funcion para traer la informacion de un solo usuario
        $data = $this->model->getOneProducto($id); //Mandamos la peticion al modelo y la guardamos en una variable
        echo json_encode($data, JSON_UNESCAPED_UNICODE); //Retornamos la respuesta
        die();
    }

    public function deleteProducto(int $id) //Funcion Eliminar Usuario
    {
        $data = $this->model->actionProducto(0, $id); //Madamos el estado 0 a la funcion de ActionUser

        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al Eliminar Producto";
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reenterProducto(int $id) //Funcion Reingresar Usuario
    {
        $data = $this->model->actionProducto(1, $id); //Madamos el estado 1 a la funcion de ActionUser

        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al Reingresar Producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    
}