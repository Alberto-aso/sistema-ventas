<?php

class Views
{
    public function getView($controlador, $vista, $data = "") //Generar classe vista recibe dor parametros el controlador y la vista
    {
        $controlador = get_class($controlador); //Creamos la variable controlador
        if ($controlador == "Home") { //Evaluamos cual es el valor del controlador para reaccionar con la vista
            $vista = "Views/" . $vista . ".php"; //Indicamos a la vista que accedera como default 
        } else {
            $vista = "Views/" . $controlador . "/" . $vista . ".php"; //indicamos al a vista que sera mandado
        }
        require $vista; //jalamos la vista
    }
}
