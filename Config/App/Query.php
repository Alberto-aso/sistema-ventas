<?php
class Query extends Conexion //Heredamos la classe conexion
{
    private $pdo, $con, $sql, $datos;
    public function __construct()
    {
        $this->pdo = new Conexion(); //Abrir conexion
        $this->con = $this->pdo->conect(); //Ejecutar metodo conect
    }
    public function select(string $sql) //Funcion select data from MySql SELECCIONAS UN USUARIO
    {
        $this->sql = $sql;
        $resul = $this->con->prepare($this->sql); //Crear consulta
        $resul->execute(); //Ejecutar Consulta
        $data = $resul->fetch(PDO::FETCH_ASSOC); //Almacenamiento de resultado con el fetch nos traemos un solo registro
        return $data;
    }

    public function selectAll(string $sql) //Funcion select data from MySql
    {
        $this->sql = $sql;
        $resul = $this->con->prepare($this->sql); //Crear consulta
        $resul->execute(); //Ejecutar Consulta
        $data = $resul->fetchAll(PDO::FETCH_ASSOC); //Almacenamiento de resultado con el fetchAll nos trae todos los registros
        return $data;
    }

    public function save(string $sql, array $datos) //Creamos la funcion save
    {
        $this->sql = $sql; //Guardamos en la variable sel sql el $sql
        $this->datos = $datos; //guardamos en la variable del datos los $datos
        $insert = $this->con->prepare($this->sql); //Insertamos en la coneccion el sql
        $data = $insert->execute($this->datos); //Mandamos en la conexion los datos y ejecutamos para guardar datos

        if ($data) { //Evaluamos si datos fue ejecutado correctamente
            $res = 1; //Mandamos respuesta 1 (Guardados correctamente)
        } else {
            $res = 0; //Mandamos respuesta error al guardar
        }

        return $res; //Retornamos la respuesta
    }
}
