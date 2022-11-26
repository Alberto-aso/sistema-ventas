<?php
//Controlados de Cajas, Categoria, Medidas
class Catalogos extends Controller
{ //Creamos la classe Catalogos
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

    //===============================================================================================================//
    //========================================= CONTROLADOR CAJAS ====================================================//

    //===============================================================================================================//
    //========================================= CONTROLADOR CATEGORIA ====================================================//

    public function listar_cajas() //Generamos el metodo listar
    {
        $data = $this->model->getCajas(); //obtenemos la consulta del metodo getCajas
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) { //Evaluamos si el caja esta activo
                $data[$i]['activo'] = '<span style="color: green;">Activo</span>'; //Agregamos la clase green para Activo
                $data[$i]['acciones'] = '<div>
                <button type="button" class="btn btn-primary btn-sm" onclick="btnEditarCaja(' . $data[$i]['id'] . ');" title="Editar"">
                <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button type="button" class="btn btn-danger btn-sm" onclick="btnEliminarCaja(' . $data[$i]['id'] . ');" title="Eliminar"">
                <i class="fas fa-trash-alt">
                </i></button>'; //Añadimos los button a cada uno de los registros
            } else {
                $data[$i]['activo'] = '<span style="color: red;">Inactivo</span>'; //Agregamos la clase red para No Activo
                $data[$i]['acciones'] = '<div>
                <button type="button" class="btn btn-success btn-sm" onclick="btnReingresarCaja(' . $data[$i]['id'] . ');" title="Reingresar"">
                <i class="fas fa-sign-in-alt"></i></i>
                </button>'; //Añadimos los button a cada uno de los registros
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE); //Retornamos la respuesta
        die();
    }

    public function newCaja() //Creamos la funcion para registrar usuario o editar
    { //Creamos la funcion para registrar usuario o editar
        $id_caja = $_POST['id_caja']; //Guardamos el id del cliente a actrualizar
        $nombre = $_POST['nombre_caja']; //Guardamos campo de la peticion POST

        if (empty($nombre)) { //Validamos que los campos esten completos
            $msg = "Faltan campos Obligatorios"; //Mensaje de error
        } else {
            if ($id_caja == "") { //evaluamos el el id del usuairoienteno es vacio para acutalizarlo o e snuevo

                $data = $this->model->postCaja($nombre); //Mandamos al metodo registrar nuevo cliente

                if ($data == "ok") { //Evaluamos la respuesta de el INSERT o UPDATE
                    $msg = "ok";
                } else if ($data == "existe") { //Mandamos error de que ya existe el cliente
                    $msg = "Caja ya Registrada";
                } else {
                    $msg = "Error al registrar caja"; //Mendaje de error al insertar datos
                }
            } else {

                $data = $this->model->updateCaja($nombre, $id_caja); //Mandamos a llamar al metodo update del modelo

                if ($data == "modificado") { //Mandamos la respuesta d emodificado
                    $msg = "modificado";
                } else {
                    $msg = "Error al modificar caja"; //Mandamos mensaje de error al actualizar usuario
                }
            }
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE); //Retornamos el mensaje obtenido de la peticion 
        die();
    }

    public function editCaja(int $id) //Creamos la funcion para traer la informacion de un solo cliente
    {
        $data = $this->model->getOneCaja($id); //Mandamos la peticion al modelo y la guardamos en una variable
        echo json_encode($data, JSON_UNESCAPED_UNICODE); //Retornamos la respuesta
        die();
    }

    public function deleteCaja(int $id) //Funcion Eliminar Usuario
    {
        $data = $this->model->actionCaja(0, $id); //Madamos el estado 0 a la funcion de ActionCliente

        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al Eliminar Caja";
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reenterCaja(int $id) //Funcion Reingresar Usuario
    {
        $data = $this->model->actionCaja(1, $id); //Madamos el estado 1 a la funcion de ActionCliente

        if ($data == 1) {
            $msg = "ok"; //Retornamos el mensaje que la peticion se ejecutor correctamenre
        } else {
            $msg = "Error al Reingresar Usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    //========================================= CONTROLADOR CAJAS ====================================================//
    //===============================================================================================================//
    public function listar_categorias() //Generamos el metodo listar
    {
        $data = $this->model->getCategorias(); //obtenemos la consulta del metodo getCategoria
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) { //Evaluamos si el caja esta activo
                $data[$i]['activo'] = '<span style="color: green;">Activo</span>'; //Agregamos la clase green para Activo
                $data[$i]['acciones'] = '<div>
                <button type="button" class="btn btn-primary btn-sm" onclick="btnEditarCategoria(' . $data[$i]['id'] . ');" title="Editar"">
                <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button type="button" class="btn btn-danger btn-sm" onclick="btnEliminarCategoria(' . $data[$i]['id'] . ');" title="Eliminar"">
                <i class="fas fa-trash-alt">
                </i></button>'; //Añadimos los button a cada uno de los registros
            } else {
                $data[$i]['activo'] = '<span style="color: red;">Inactivo</span>'; //Agregamos la clase red para No Activo
                $data[$i]['acciones'] = '<div>
                <button type="button" class="btn btn-dark btn-sm" onclick="btnReingresarCategoria(' . $data[$i]['id'] . ');" title="Reingresar"">
                <i class="fa-solid fa-pen-to-square"></i>
                </button>'; //Añadimos los button a cada uno de los registros
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE); //Retornamos la respuesta
        die();
    }
    public function newCategoria() //Creamos la funcion para registrar usuario o editar
    { //Creamos la funcion para registrar usuario o editar
        $id_categoria = $_POST['id_categoria']; //Guardamos el id del cliente a actrualizar
        $nombre = $_POST['nombre_categoria']; //Guardamos campo de la peticion POST

        if (empty($nombre)) { //Validamos que los campos esten completos
            $msg = "Faltan campos Obligatorios"; //Mensaje de error
        } else {
            if ($id_categoria == "") { //evaluamos el el id del usuairoienteno es vacio para acutalizarlo o e snuevo

                $data = $this->model->postCategoria($nombre); //Mandamos al metodo registrar nuevo cliente

                if ($data == "ok") { //Evaluamos la respuesta de el INSERT o UPDATE
                    $msg = "ok";
                } else if ($data == "existe") { //Mandamos error de que ya existe el cliente
                    $msg = "Categoria ya Registrada";
                } else {
                    $msg = "Error al registrar caja"; //Mendaje de error al insertar datos
                }
            } else {

                $data = $this->model->updateCategoria($nombre, $id_categoria); //Mandamos a llamar al metodo update del modelo

                if ($data == "modificado") { //Mandamos la respuesta d emodificado
                    $msg = "modificado";
                } else {
                    $msg = "Error al modificar Categoria"; //Mandamos mensaje de error al actualizar usuario
                }
            }
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE); //Retornamos el mensaje obtenido de la peticion 
        die();
    }

    public function editCategoria(int $id) //Creamos la funcion para traer la informacion de un solo cliente
    {
        $data = $this->model->getOneCategoria($id); //Mandamos la peticion al modelo y la guardamos en una variable
        echo json_encode($data, JSON_UNESCAPED_UNICODE); //Retornamos la respuesta
        die();
    }

    public function deleteCategoria(int $id) //Funcion Eliminar Usuario
    {
        $data = $this->model->actionCategoria(0, $id); //Madamos el estado 0 a la funcion de ActionCliente

        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al Eliminar Caja";
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reenterCategoria(int $id) //Funcion Reingresar Usuario
    {
        $data = $this->model->actionCategoria(1, $id); //Madamos el estado 1 a la funcion de ActionCliente

        if ($data == 1) {
            $msg = "ok"; //Retornamos el mensaje que la peticion se ejecutor correctamenre
        } else {
            $msg = "Error al Reingresar Usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }


    //========================================= CONTROLADOR CATEGORIA ====================================================//
    //===============================================================================================================//

    //===============================================================================================================//
    //========================================= CONTROLADOR MEDIDAD ====================================================//
    public function listar_medidas() //Generamos el metodo listar
    {
        $data = $this->model->getMedidas(); //obtenemos la consulta del metodo getCategoria
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) { //Evaluamos si el caja esta activo
                $data[$i]['activo'] = '<span style="color: green;">Activo</span>'; //Agregamos la clase green para Activo
                $data[$i]['acciones'] = '<div>
                <button type="button" class="btn btn-primary btn-sm" onclick="btnEditarMedida(' . $data[$i]['id'] . ');" title="Editar"">
                <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button type="button" class="btn btn-danger btn-sm" onclick="btnEliminarMedida(' . $data[$i]['id'] . ');" title="Eliminar"">
                <i class="fas fa-trash-alt">
                </i></button>'; //Añadimos los button a cada uno de los registros
            } else {
                $data[$i]['activo'] = '<span style="color: red;">Inactivo</span>'; //Agregamos la clase red para No Activo
                $data[$i]['acciones'] = '<div>
                <button type="button" class="btn btn-dark btn-sm" onclick="btnReingresarMedida(' . $data[$i]['id'] . ');" title="Reingresar"">
                <i class="fa-solid fa-pen-to-square"></i>
                </button>'; //Añadimos los button a cada uno de los registros
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE); //Retornamos la respuesta
        die();
    }

    public function newMedida() //Creamos la funcion para registrar usuario o editar
    { //Creamos la funcion para registrar usuario o editar
        $id_medida = $_POST['id_medida']; //Guardamos el id del cliente a actrualizar
        $nombre = $_POST['nombre_medida']; //Guardamos campo de la peticion POST
        $nombre_corto = $_POST['nombre_corto']; //Guardamos campo de la peticion POST

        if (empty($nombre) || empty($nombre_corto)) { //Validamos que los campos esten completos
            $msg = "Faltan campos Obligatorios"; //Mensaje de error
        } else {
            if ($id_medida == "") { //evaluamos el el id del usuairoienteno es vacio para acutalizarlo o e snuevo

                $data = $this->model->postMedida($nombre, $nombre_corto); //Mandamos al metodo registrar nuevo cliente

                if ($data == "ok") { //Evaluamos la respuesta de el INSERT o UPDATE
                    $msg = "ok";
                } else if ($data == "existe") { //Mandamos error de que ya existe el cliente
                    $msg = "Medida ya Registrada";
                } else {
                    $msg = "Error al registrar caja"; //Mendaje de error al insertar datos
                }
            } else {

                $data = $this->model->updateMedida($nombre, $nombre_corto, $id_medida); //Mandamos a llamar al metodo update del modelo

                if ($data == "modificado") { //Mandamos la respuesta d emodificado
                    $msg = "modificado";
                } else {
                    $msg = "Error al modificar Medida"; //Mandamos mensaje de error al actualizar usuario
                }
            }
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE); //Retornamos el mensaje obtenido de la peticion 
        die();
    }

    public function editMedida(int $id) //Creamos la funcion para traer la informacion de un solo cliente
    {
        $data = $this->model->getOneMedida($id); //Mandamos la peticion al modelo y la guardamos en una variable
        echo json_encode($data, JSON_UNESCAPED_UNICODE); //Retornamos la respuesta
        die();
    }

    public function deleteMedida(int $id) //Funcion Eliminar Usuario
    {
        $data = $this->model->actionMedida(0, $id); //Madamos el estado 0 a la funcion de ActionCliente

        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al Eliminar Medida";
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reenterMedida(int $id) //Funcion Reingresar Usuario
    {
        $data = $this->model->actionMedida(1, $id); //Madamos el estado 1 a la funcion de ActionCliente

        if ($data == 1) {
            $msg = "ok"; //Retornamos el mensaje que la peticion se ejecutor correctamenre
        } else {
            $msg = "Error al Reingresar Medida";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    //========================================= CONTROLADOR MEDIDAD ====================================================//
    //===============================================================================================================//
}
