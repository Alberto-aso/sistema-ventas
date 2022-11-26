<?php
//Las variables de DB se encuentran en Config.php
class Conexion
{
    private $conect; //Variable Conexion al servidor de control de veivulos para la tabla de usuarios 192.3.202.100
    public function __construct()
    {
        $pdo = "mysql:host=" . host_control_usuarios . ";dbname=" . db_control_usuarios . ";charset=utf8"; // Conexion a base de datos
        try {
            $this->conect = new PDO($pdo, user_control_usuarios, password_control_usuarios); //Enviar Credenciales a la conexion
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Atributos
        } catch (PDOException $err) {
            echo "Error en la conexion DB" . $err->getMessage();
        }
    }
    public function conect()
    {
        return $this->conect; //Retornamos la conexion
    }
}
