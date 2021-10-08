<?php 
session_start();
//Index php para recoger parametros get por la url (A esto le llamamos controlador frontal)

require_once 'autoload.php'; //autoload para aumentar evitar codigo redundante
require_once 'config/db.php';
require_once 'config/parameters.php'; //Para cargar el base url
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

//Conexion base de datos
$db = Database::connect();


function show_error() {
    $error = new ErrorController();
    $error->index();
    exit(); //Para la ejecucion para que no empiece la linea de abajo
}


if (isset($_GET['controller'])) { //comprobamos si el controlador que llega por la url es valido de otro modo cortamos la ejecucion
    $nombre_controlador = $_GET['controller'].'Controller';
    //var_dump(ucwords($nombre_controlador));
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])) {
    $nombre_controlador = controller_default;
} 
else {
    // echo 'La pagina que buscas no existe';
    show_error();
}

if (class_exists($nombre_controlador)) { //Si existe la clase creamos el objeto
    $controlador = new $nombre_controlador(); //Objeto controlador
    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])) { //tambien comprobamos si la accion que nos llega por parametro existe
        $action = $_GET['action'];
        $controlador->$action(); //utilizamos el metodo proporcionado por la url
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])) {
        $default_action = action_default;
        $controlador->$default_action();
    } 
    else {
        show_error();
    }
} else {
    show_error();
}

require_once 'views/layout/footer.php';

// $controlador = new UsuarioController();
// $controlador->mostrarTodos();
// $controlador->crear();

