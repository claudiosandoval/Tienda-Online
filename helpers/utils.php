<?php 
//Clase utils la cual contiene metodos que estaremos utilizando repetidamente dentro del proyecto
class Utils {
    public static function deleteSession($name) {
        if(isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }  
    }

    public static function isAdmin() {
        if(!isset($_SESSION['admin'])) {
            header("Location:".base_url);
        }
    }

    public static function showCategorias() {
        require_once 'models/categoria.php';
        $categorias = new categoria();
        $categorias = $categorias->getCategorias();

        return $categorias;
    }

    public static function statsCarrito() { //Devuelve las estadisticas del carrito
        $stats = array(
            'count' => 0,
            'total' => 0
        );

        if(isset($_SESSION['carrito'])) { //Creamos un array con datos reales del carrito si no utilizaremos el array creado anteriormente
            $stats['count'] = count($_SESSION['carrito']);
            foreach ($_SESSION['carrito'] as $producto) {
                $stats['total'] += $producto['precio'] * $producto['unidades'];
            }
        }

        return $stats;
    }
}