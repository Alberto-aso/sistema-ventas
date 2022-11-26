<?php
class UsuariosModel extends Query{ //Creamos la clase Usuarios Model
    private $num_empleado, $nombre, $clave, $caja_id, $id_usuario, $estado; //Creamos las variables privadas para el modelo
    public function __construct()
    {
        parent::__construct(); //Abrimos el constructor
    }

    public function getUsuario(string $usuario, string $clave) //Creamos la funcion para ejecutar la consulta y crear el query
    {
        $sql = "SELECT * FROM usuarios WHERE num_empleado = '$usuario' AND clave = '$clave'"; //Creamos la consulta de sql
        $data = $this->select($sql); //M<andamos la consulta al selec que tenemos en la clase Query
        return $data; //Retornamos el resultado que nos de la consulta
    }

    public function getUsuarios()
    { //Generamos la funcion para obtener todos los usuarios
        $sql = "SELECT u.*, c.id as id_caja, c.caja FROM usuarios as u INNER JOIN caja AS c ON u.id_caja = c.id;"; //Generamos el query de consulta
        $data = $this->selectAll($sql); //mandamos a llamar al metodo selectAll 
        return $data; //Retornamos el resultado de la consulta
    }

    public function getCajas() //Creamos la funcion para ejecutar la consulta y crear el query
    {
        $sql = "SELECT * FROM caja WHERE estado = 1"; //Creamos la consulta de sql
        $data = $this->selectAll($sql); //M<andamos laa consulta al selec que tenemos en la clase Query
        return $data; //Retornamos el resultado que nos de la consulta
    }

    public function getOneUser(int $id)
    { //Creamos la funcion para traer la informacion de un solo usuario apra editar

        $this->usuario_id = $id; //Guardamos el id 

        $sql = "SELECT * FROM usuarios WHERE id = '$this->usuario_id'"; //Creamos el query de consulta
        $data = $this->select($sql); //Mandamos la peticion
        return $data; //Retornamos la data de la peticion
    }

    public function postUsuario(string $num_empleado, string $nombre, string $clave, int $caja_id)
    { //Creamos la funcion nuevo usuario 
        $this->num_empleado = $num_empleado; //Guardamos la variable que resivimos del controlador
        $this->nombre = strtoupper($nombre); //Guardamos la variable que resivimos del controlador convertimos a mayuscula
        $this->clave = $clave; //Guardamos la variable que resivimos del controlador
        $this->caja_id = $caja_id; //Guardamos la variable que resivimos del controlador

        $verificar = "SELECT * FROM usuarios WHERE num_empleado = '$this->num_empleado'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO usuarios (num_empleado, nombre, clave, id_caja) VALUES (?, ?, ?, ?)"; //Creamos el query
            $datos = array($this->num_empleado, $this->nombre, $this->clave, $this->caja_id); //Creamos el array de datos por insertar

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
    public function updateUsuario(string $num_empleado, string $nombre, int $caja_id, int $id_usuario)//Creamos la funcion modificar usuario 
    {         
        $this->id_usuario = $id_usuario; //Guardamos el id de lusuario a actualizar
        $this->num_empleado = $num_empleado; //Guardamos la variable que resivimos del controlador
        $this->nombre = strtoupper($nombre); //Guardamos la variable que resivimos del controlador convertimos a mayuscula
        $this->caja_id = $caja_id; //Guardamos la variable que resivimos del controlador

        $sql = "UPDATE usuarios SET num_empleado = ?, nombre = ?, id_caja = ? WHERE id = ?"; //Creamos el query
        $datos = array($this->num_empleado, $this->nombre, $this->caja_id, $this->id_usuario); //Creamos el array de datos por insertar

        $data = $this->save($sql, $datos); //Mandamos a la funcion save los datos y el query

        if ($data == 1) { //Evaluamos la respuesta
            $res = "modificado";
        } else {
            $res = "error";
        }

        return $res; //Retornamos la respuesta
    }
    public function actionUser(int $estado, int $id) //Eliminar o Reingresar usuario
    {
        $this->id = $id; //Guardamos Id del usuario
        $this->estado = $estado; //Guardamos Id del usuario
        $sql = "UPDATE usuarios SET estado = ? WHERE id = ?"; //Creamos consulta sql
        $datos = array($this->estado, $this->id); //Creamos el arreglo con el Id
        $data = $this->save($sql, $datos); //Mandamos a llamar a save
        return $data; //retornamos la respuesta
    }
}