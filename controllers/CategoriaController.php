<?php 
require_once 'models/categoria.php';
require_once 'models/producto.php';

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

    public function ver() {

        if(isset($_GET['id'])){
            // var_dump($_GET['id']);
            $id = $_GET['id'];  
            $categoria = new categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOneCategoria(); //Conseguir la categoria en especifico para luego utilizar la variable en la vista
            // var_dump($categoria);

            //Conseguir productos
            $productos = new Producto();
            $productos->setCategoria_id($id);
            $productos = $productos->getProductosCategoria(); //Conseguir todos los productos con el id especifico de la categoria
        }

        require_once 'views/categoria/ver.php';
    }


}