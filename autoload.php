<?php 

function controller_autoload($classname) { //funcion que incluye todos los controladores de la carpeta especifica
    @include 'controllers/'.$classname.'.php'; //debido a que en el index depuramos los errores con un if, antepoemos un arroba para esconder los warning
}

spl_autoload_register('controller_autoload'); //registra todas las clases existentes en la funcion anteriormente definida (autoload)