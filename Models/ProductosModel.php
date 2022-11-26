<?php
class ProductosModel extends Query
{ //Creamos la clase Usuarios Model
    private $producto_id, $codigo, $descripcion, $precio_venta, $precio_compra, $id_categoria, $id_medida, $cantidad, $estad0; //Creamos las variables privadas para el modelo
    public function __construct()
    {
        parent::__construct(); //Abrimos el constructor
    }


    public function getProductos()
    { //Generamos la funcion para obtener todos los usuarios
        $sql = "SELECT p.*, c.id AS categoria_id, c.nombre AS nombre_categoria, m.id AS medida_id, m.nombre AS nombre_medida FROM productos AS p INNER JOIN categoria as c ON c.id = p.id_categoria 
        INNER JOIN medida AS m ON m.id = p.id_medida;"; //Generamos el query de consulta
        $data = $this->selectAll($sql); //mandamos a llamar al metodo selectAll 
        return $data; //Retornamos el resultado de la consulta
    }

    public function getCategorias() //Creamos la funcion para ejecutar la consulta y crear el query
    {
        $sql = "SELECT * FROM categoria WHERE estado = 1"; //Creamos la consulta de sql
        $data = $this->selectAll($sql); //M<andamos laa consulta al selec que tenemos en la clase Query
        return $data; //Retornamos el resultado que nos de la consulta
    }

    public function getMedidas() //Creamos la funcion para ejecutar la consulta y crear el query
    {
        $sql = "SELECT * FROM medida WHERE estado = 1"; //Creamos la consulta de sql
        $data = $this->selectAll($sql); //M<andamos laa consulta al selec que tenemos en la clase Query
        return $data; //Retornamos el resultado que nos de la consulta
    }

    public function getOneProducto(int $id)
    { //Creamos la funcion para traer la informacion de un solo usuario apra editar

        $this->producto_id = $id; //Guardamos el id 

        $sql = "SELECT * FROM productos WHERE id = '$this->producto_id'"; //Creamos el query de consulta
        $data = $this->select($sql); //Mandamos la peticion
        return $data; //Retornamos la data de la peticion
    }

    public function postProducto(string $codigo, string $descipcion, float $precio_compra, float $precio_venta, int $medida_id, int $categoria_id, float $cantidad)
    { //Creamos la funcion nuevo usuario 
        $this->codigo = strtoupper($codigo); //Guardamos la variable que resivimos del controlador
        $this->descripcion = strtoupper($descipcion); //Guardamos la variable que resivimos del controlador convertimos a mayuscula
        $this->precio_compra = $precio_compra; //Guardamos la variable que resivimos del controlador
        $this->precio_venta = $precio_venta; //Guardamos la variable que resivimos del controlador
        $this->id_medida = $medida_id; //Guardamos la variable que resivimos del controlador
        $this->id_categoria = $categoria_id; //Guardamos la variable que resivimos del controlador
        $this->cantidad = $cantidad; //Guardamos la variable que resivimos del controlador

        $verificar = "SELECT * FROM productos WHERE codigo = '$this->codigo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO productos (codigo, descripcion, precio_compra, precio_venta, id_medida, id_categoria, cantidad) VALUES (?, ?, ?, ?, ?, ?, ?)"; //Creamos el query
            $datos = array($this->codigo, $this->descripcion, $this->precio_compra, $this->precio_venta, $this->id_medida, $this->id_categoria, $this->cantidad); //Creamos el array de datos por insertar

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
    public function updateProducto(string $codigo, string $descipcion, float $precio_compra, float $precio_venta, int $medida_id, int $categoria_id, float $cantidad, int $producto_id) //Creamos la funcion modificar usuario 
    {
        $this->producto_id = $producto_id; //Guardamos el id de lusuario a actualizar
        $this->codigo = strtoupper($codigo); //Guardamos la variable que resivimos del controlador
        $this->descripcion = strtoupper($descipcion); //Guardamos la variable que resivimos del controlador convertimos a mayuscula
        $this->precio_compra = $precio_compra; //Guardamos la variable que resivimos del controlador
        $this->precio_venta = $precio_venta; //Guardamos la variable que resivimos del controlador
        $this->id_medida = $medida_id; //Guardamos la variable que resivimos del controlador
        $this->id_categoria = $categoria_id; //Guardamos la variable que resivimos del controlador
        $this->cantidad = $cantidad; //Guardamos la variable que resivimos del controlador

        $sql = "UPDATE productos SET codigo = ?, descripcion = ?, precio_compra = ?, precio_venta = ?, id_medida = ?, id_categoria = ?, cantidad = ? WHERE id = ?"; //Creamos el query
        $datos = array($this->codigo, $this->descripcion, $this->precio_compra, $this->precio_venta, $this->id_medida, $this->id_categoria, $this->cantidad, $this->producto_id); //Creamos el array de datos por insertar

        $data = $this->save($sql, $datos); //Mandamos a la funcion save los datos y el query

        if ($data == 1) { //Evaluamos la respuesta
            $res = "modificado";
        } else {
            $res = "error";
        }

        return $res; //Retornamos la respuesta
    }
    public function actionProducto(int $estado, int $id) //Eliminar o Reingresar usuario
    {
        $this->id = $id; //Guardamos Id del usuario
        $this->estado = $estado; //Guardamos Id del usuario
        $sql = "UPDATE productos SET estado = ? WHERE id = ?"; //Creamos consulta sql
        $datos = array($this->estado, $this->id); //Creamos el arreglo con el Id
        $data = $this->save($sql, $datos); //Mandamos a llamar a save
        return $data; //retornamos la respuesta
    }
}
