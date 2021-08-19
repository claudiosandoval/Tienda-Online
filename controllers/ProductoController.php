<?php 

class ProductoController {
    public function index() { //funcion para probar el layout
    //echo "Controlador productos, Accion index";

    //Renderizar vista
    require_once 'views/producto/destacados.php';
    }

    public function gestion() {
        Utils::isAdmin();

        require_once 'models/producto.php';

        $producto = new Producto();

        $productos = $producto->getProductos(); //Devuelve el mysql result con todos los productos

        require_once 'views/producto/gestionar.php';
    }

    public function crear() {
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    public function save() {
        
    }

    

}