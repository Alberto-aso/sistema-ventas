<?php
class Controller //Creamos la clase controler 
{

    public function __construct()
    {
        $this->views = new Views(); //Seleccionamo la instancia de vista
        $this->cargarModel(); //Jalam9os la funcion cargar modelo
    }

    public function cargarModel()  //Funcion para cargar el modelo
    {
        $model = get_class($this) . "Model"; // Obtener classe de modelo
        $ruta = "Models/" . $model . ".php"; //generar ruta del modelo
        if (file_exists($ruta)) { //Validamos si eciste el archivo modelo
            require_once $ruta;
            $this->model = new $model();
        }
    }
}
