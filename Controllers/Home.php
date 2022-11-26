<?php
class Home extends Controller //Creamos la clase Home y jalamos el Controller
{
    public function __construct()
    {
        session_start();
        if (!empty($_SESSION['activo_sistema_ventas'])) {
            header("location: ". base_url . "Usuarios");
        }
        parent::__construct();
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
}
