<?php
spl_autoload_register(function ($class) { 
    if (file_exists("Config/App/" . $class . ".php")) { //Verificamos si existe el archivo que se encuentras en la carpeta Config 
        require_once "Config/App/" . $class . ".php"; // Si existe vamos a requerirlo y lo jalamos con requiere_once 
    }
});
