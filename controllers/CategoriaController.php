<?php 
require_once 'models/categoria.php';

class CategoriaController {
    public function index() {
        // echo "Controlador categoria, Accion index"; 
        Utils::isAdmin();
        $categoria = new categoria();

        $categorias = $categoria->getCategorias();

        require_once 'views/categoria/index.php';
    } 

    public function crear() {
        Utils::isAdmin(); //funcion estatica que restringe a usuarios que no sean admin a entrar a pestañas que son solo para administrador
        require_once 'views/categoria/crear.php';
    }

    public function save() {
        Utils::isAdmin(); //Solo usuario admin puede guardar una categoria

        // var_dump($_POST);
        // die();

        if(isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false; //Parametro enviado por post desde el formulario
            if($nombre) {
                $categoria = new categoria(); //Instanciamos el objeto
                $categoria->setNombre($nombre); //Seteamos el nombre escrito en el formulario
                $save = $categoria->save();

                if($save) {
                    $_SESSION['register'] = "complete";
                }else {
                    $_SESSION['register'] = "failed";
                }
            }else {
                $_SESSION['register'] = "failed";
            }
        }else {
            $_SESSION['register'] = "failed";
        }

        // var_dump($_SESSION['register']);
        // die();

        header("Location:".base_url."categoria/index");
    }


}