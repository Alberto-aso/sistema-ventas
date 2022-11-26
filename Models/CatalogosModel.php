<?php
class CatalogosModel extends Query
{ //Creamos la clase Usuarios Model
    private $nombre, $nombre_corto, $id_caja, $id_categoria, $id_medida, $estado; //Creamos las variables privadas para el modelo
    public function __construct()
    {
        parent::__construct(); //Abrimos el constructor
    }

    //========================================= Modelo CAJAS ==================================================//
    //========================================================================================================//
    public function getCajas()
    { //Generamos la funcion para obtener todos los Cajas
        $sql = "SELECT c.* FROM caja as c;"; //Generamos el query de consulta
        $data = $this->selectAll($sql); //mandamos a llamar al metodo selectAll 
        return $data; //Retornamos el resultado de la consulta
    }

    public function getOneCaja(int $id)
    { //Creamos la funcion para traer la informacion de un solo caja apra editar
        $this->id_caja = $id; //Guardamos el id 

        $sql = "SELECT * FROM caja WHERE id = '$this->id_caja'"; //Creamos el query de consulta
        $data = $this->select($sql); //Mandamos la peticion
        return $data; //Retornamos la data de la peticion
    }

    public function postCaja(string $nombre)
    { //Creamos la funcion nuevo Caja 
        $this->nombre = strtoupper($nombre); //Guardamos la variable que resivimos del controlador convertimos a mayuscula

        $verificar = "SELECT * FROM caja WHERE caja = '$this->nombre'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO caja (caja) VALUES (?)"; //Creamos el query
            $datos = array($this->nombre); //Creamos el array de datos por insertar

            $data = $this->save($sql, $datos); //Mandamos a la funcion save los datos y el query

            if ($data == 1) { //Evaluamos la respuesta
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }

        return $res; //Retornamos la respuesta
    }
    public function updateCaja(string $nombre, $id_caja) //Creamos la funcion modificar caja 
    {
        $this->id_caja = $id_caja; //Guardamos el id de cliente a actualizar
        $this->nombre = strtoupper($nombre); //Guardamos la variable que resivimos del controlador convertimos a mayuscula

        $sql = "UPDATE caja SET caja = ? WHERE id = ?"; //Creamos el query
        $datos = array($this->nombre, $this->id_caja); //Creamos el array de datos por insertar

        $data = $this->save($sql, $datos); //Mandamos a la funcion save los datos y el query

        if ($data == 1) { //Evaluamos la respuesta
            $res = "modificado";
        } else {
            $res = "error";
        }

        return $res; //Retornamos la respuesta
    }

    public function actionCaja(int $estado, int $id_caja) //Eliminar o Reingresar caja
    {
        $this->id_caja = $id_caja; //Guardamos Id del cliente
        $this->estado = $estado; //Guardamos Id del cliente
        $sql = "UPDATE caja SET estado = ? WHERE id = ?"; //Creamos consulta sql
        $datos = array($this->estado, $this->id_caja); //Creamos el arreglo con el Id
        $data = $this->save($sql, $datos); //Mandamos a llamar a save
        return $data; //retornamos la respuesta
    }
    //========================================= Modelo CAJAS ==================================================//
    //========================================================================================================//

    //========================================= Modelo CATEGORIA ==================================================//
    //========================================================================================================//
    public function getCategorias()
    { //Generamos la funcion para obtener todos los Cajas
        $sql = "SELECT c.* FROM categoria as c;"; //Generamos el query de consulta
        $data = $this->selectAll($sql); //mandamos a llamar al metodo selectAll 
        return $data; //Retornamos el resultado de la consulta
    }

    public function getOneCategoria(int $id)
    { //Creamos la funcion para traer la informacion de un solo caja apra editar
        $this->id_categoria = $id; //Guardamos el id 

        $sql = "SELECT * FROM categoria WHERE id = '$this->id_categoria'"; //Creamos el query de consulta
        $data = $this->select($sql); //Mandamos la peticion
        return $data; //Retornamos la data de la peticion
    }

    public function postCategoria(string $nombre)
    { //Creamos la funcion nuevo Caja 
        $this->nombre = strtoupper($nombre); //Guardamos la variable que resivimos del controlador convertimos a mayuscula

        $verificar = "SELECT * FROM categoria WHERE nombre = '$this->nombre'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO categoria (nombre) VALUES (?)"; //Creamos el query
            $datos = array($this->nombre); //Creamos el array de datos por insertar

            $data = $this->save($sql, $datos); //Mandamos a la funcion save los datos y el query

            if ($data == 1) { //Evaluamos la respuesta
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }

        return $res; //Retornamos la respuesta
    }
    public function updateCategoria(string $nombre, $id_categoria) //Creamos la funcion modificar caja 
    {
        $this->id_categoria = $id_categoria; //Guardamos el id de cliente a actualizar
        $this->nombre = strtoupper($nombre); //Guardamos la variable que resivimos del controlador convertimos a mayuscula

        $sql = "UPDATE categoria SET nombre = ? WHERE id = ?"; //Creamos el query
        $datos = array($this->nombre, $this->id_categoria); //Creamos el array de datos por insertar

        $data = $this->save($sql, $datos); //Mandamos a la funcion save los datos y el query

        if ($data == 1) { //Evaluamos la respuesta
            $res = "modificado";
        } else {
            $res = "error";
        }

        return $res; //Retornamos la respuesta
    }

    public function actionCategoria(int $estado, int $id_categoria) //Eliminar o Reingresar caja
    {
        
        $this->id_categoria = $id_categoria; //Guardamos Id del cliente
        $this->estado = $estado; //Guardamos Id del cliente
        $sql = "UPDATE categoria SET estado = ? WHERE id = ?"; //Creamos consulta sql
        $datos = array($this->estado, $this->id_categoria); //Creamos el arreglo con el Id
        $data = $this->save($sql, $datos); //Mandamos a llamar a save
        return $data; //retornamos la respuesta
    }
    //========================================= Modelo CATEGORIA ==================================================//
    //========================================================================================================//

    //========================================= Modelo MEDIDAS ==================================================//
    //========================================================================================================//
    public function getMedidas()
    { //Generamos la funcion para obtener todos los Cajas
        $sql = "SELECT m.* FROM medida as m;"; //Generamos el query de consulta
        $data = $this->selectAll($sql); //mandamos a llamar al metodo selectAll 
        return $data; //Retornamos el resultado de la consulta
    }

    public function getOneMedida(int $id)
    { //Creamos la funcion para traer la informacion de un solo caja apra editar
        $this->id_medida = $id; //Guardamos el id 

        $sql = "SELECT * FROM medida WHERE id = '$this->id_medida'"; //Creamos el query de consulta
        $data = $this->select($sql); //Mandamos la peticion
        return $data; //Retornamos la data de la peticion
    }

    public function postMedida(string $nombre, string $nombre_corto)
    { //Creamos la funcion nuevo Caja 

        $this->nombre = strtoupper($nombre); //Guardamos la variable que resivimos del controlador convertimos a mayuscula
        $this->nombre_corto = strtoupper($nombre_corto); //Guardamos la variable que resivimos del controlador convertimos a mayuscula

        $verificar = "SELECT * FROM medida WHERE nombre = '$this->nombre'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO medida (nombre, nombre_corto) VALUES (?, ?)"; //Creamos el query
            $datos = array($this->nombre, $this->nombre_corto); //Creamos el array de datos por insertar

            $data = $this->save($sql, $datos); //Mandamos a la funcion save los datos y el query

            if ($data == 1) { //Evaluamos la respuesta
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }

        return $res; //Retornamos la respuesta
    }
    public function updateMedida(string $nombre, string $nombre_corto, $id_medida) //Creamos la funcion modificar caja 
    {
        $this->id_medida = $id_medida; //Guardamos el id de cliente a actualizar
        $this->nombre = strtoupper($nombre); //Guardamos la variable que resivimos del controlador convertimos a mayuscula
        $this->nombre_corto = strtoupper($nombre_corto); //Guardamos la variable que resivimos del controlador convertimos a mayuscula

        $sql = "UPDATE medida SET nombre = ?, nombre_corto = ? WHERE id = ?"; //Creamos el query
        $datos = array($this->nombre, $this->nombre_corto, $this->id_medida); //Creamos el array de datos por insertar

        $data = $this->save($sql, $datos); //Mandamos a la funcion save los datos y el query

        if ($data == 1) { //Evaluamos la respuesta
            $res = "modificado";
        } else {
            $res = "error";
        }

        return $res; //Retornamos la respuesta
    }

    public function actionMedida(int $estado, int $id_medida) //Eliminar o Reingresar caja
    {
        $this->id_medida = $id_medida; //Guardamos Id del cliente
        $this->estado = $estado; //Guardamos Id del cliente
        $sql = "UPDATE medida SET estado = ? WHERE id = ?"; //Creamos consulta sql
        $datos = array($this->estado, $this->id_medida); //Creamos el arreglo con el Id
        $data = $this->save($sql, $datos); //Mandamos a llamar a save
        return $data; //retornamos la respuesta
    }
    //========================================= Modelo MEDIDAS ==================================================//
    //========================================================================================================//
}
