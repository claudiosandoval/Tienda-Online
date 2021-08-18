<?php 

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
}