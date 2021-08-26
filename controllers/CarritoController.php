<?php 
require_once 'models/producto.php';
class CarritoController {
    public function index() {
        // echo "Controlador carrito, Accion index";
        echo "<br>";
        // var_dump($_SESSION['carrito']);
        $carrito = $_SESSION['carrito'];

        require_once 'views/carrito/index.php';
    }

    public function add() {

        if(isset($_GET['id'])) {
            $producto_id = $_GET['id'];
            var_dump($producto_id);
        }else {
            header("Location:".base_url);
        }

        if(isset($_SESSION['carrito'])) {
            // Utils::deleteSession('carrito');
            $counter = 0;
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if($elemento['id_producto'] == $producto_id) {
                    $unidades = intval($_POST['unidades']);
                    $_SESSION['carrito'][$indice]['unidades'] += $unidades; //Accedemos al indice del elemento para asignar la suma de las unidades ingresadas en el input de la vista
                    $counter++; //Contador para verificar si el producto ya ha sido agregado
                }
            }
        }
        
        if(!isset($counter) || $counter == 0) {

            $producto = new Producto();
            $producto->setId($producto_id);
            $unidades = !empty($_POST['unidades']) ? intval($_POST['unidades']) : '1';      
            $producto = $producto->getOneProduct();
            
            if(is_object($producto)) {
                $_SESSION['carrito'][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "producto" => $producto, //agregamos al array el producto completo
                    "unidades" => $unidades
                );       
            }
        }
        

        header("Location:".base_url."carrito/index");
    }

    public function remove() {

    }

    public function delete_all() {
        utils::deleteSession('carrito');
    }
}