<?php
class ClientesModel extends Query{ //Creamos la clase Usuarios Model
    private $ine, $nombre, $telefono, $direccion, $id_cliente, $estado; //Creamos las variables privadas para el modelo
    public function __construct()
    {
        parent::__construct(); //Abrimos el constructor
    }

    public function getClientes()
    { //Generamos la funcion para obtener todos los clientes
        $sql = "SELECT c.* FROM clientes as c;"; //Generamos el query de consulta
        $data = $this->selectAll($sql); //mandamos a llamar al metodo selectAll 
        return $data; //Retornamos el resultado de la consulta
    }

    public function getOneCliente(int $id)
    { //Creamos la funcion para traer la informacion de un solo usuario apra editar
        $this->id_cliente = $id; //Guardamos el id 

        $sql = "SELECT * FROM clientes WHERE id = '$this->id_cliente'"; //Creamos el query de consulta
        $data = $this->select($sql); //Mandamos la peticion
        return $data; //Retornamos la data de la peticion
    }

    public function postCliente(string $ine, string $nombre, string $telefono, string $direccion)
    { //Creamos la funcion nuevo cliente 
        $this->ine = strtoupper($ine); //Guardamos la variable que resivimos del controlador
        $this->nombre = strtoupper($nombre); //Guardamos la variable que resivimos del controlador convertimos a mayuscula
        $this->telefono = strtoupper($telefono); //Guardamos la variable que resivimos del controlador
        $this->direccion = strtoupper($direccion); //Guardamos la variable que resivimos del controlador

        $verificar = "SELECT * FROM clientes WHERE ine = '$this->ine'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO clientes (ine, nombre, telefono, direccion) VALUES (?, ?, ?, ?)"; //Creamos el query
            $datos = array($this->ine, $this->nombre, $this->telefono, $this->direccion); //Creamos el array de datos por insertar

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
    public function updateCliente(string $ine, string $nombre, string $telefono, string $direccion, $id_cliente)//Creamos la funcion modificar usuario 
    {         
        $this->id_cliente = $id_cliente; //Guardamos el id de cliente a actualizar
        $this->ine = strtoupper($ine); //Guardamos la variable que resivimos del controlador
        $this->nombre = strtoupper($nombre); //Guardamos la variable que resivimos del controlador convertimos a mayuscula
        $this->telefono = $telefono; //Guardamos la variable que resivimos del controlador
        $this->direccion = strtoupper($direccion);

        $sql = "UPDATE clientes SET ine = ?, nombre = ?, telefono = ?, direccion = ? WHERE id = ?"; //Creamos el query
        $datos = array($this->ine, $this->nombre, $this->telefono, $this->direccion, $this->id_cliente); //Creamos el array de datos por insertar

        $data = $this->save($sql, $datos); //Mandamos a la funcion save los datos y el query

        if ($data == 1) { //Evaluamos la respuesta
            $res = "modificado";
        } else {
            $res = "error";
        }

        return $res; //Retornamos la respuesta
    }

    public function actionCliente(int $estado, int $id) //Eliminar o Reingresar usuario
    {
        $this->id_cliente = $id; //Guardamos Id del cliente
        $this->estado = $estado; //Guardamos Id del cliente
        $sql = "UPDATE clientes SET estado = ? WHERE id = ?"; //Creamos consulta sql
        $datos = array($this->estado, $this->id_cliente); //Creamos el arreglo con el Id
        $data = $this->save($sql, $datos); //Mandamos a llamar a save
        return $data; //retornamos la respuesta
    }
}
