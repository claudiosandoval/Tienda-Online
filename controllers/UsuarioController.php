<?php 
require_once 'models/usuario.php';


class UsuarioController {
    public function index() {
        echo "Controlador usuario, Accion index";
    }

    public function registro() {
        require_once 'views/usuario/registro.php';
    }

    public function save() {
        // if(isset($_POST)) {
        //     var_dump($_POST);
        // }

        if(isset($_POST)) {

            $nombre = isset($_POST['nombre']) ? $_POST['nombre']: false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos']: false;
            $email = isset($_POST['email']) ? $_POST['email']: false;
            $password = isset($_POST['password']) ? $_POST['password']: false;
            $rol = isset($_POST['select']) ? $_POST['select']: false;

            if($nombre && $apellidos && $email && $password && $rol) {
                $usuario = new usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $usuario->setRol($rol);
                
                $save = $usuario->save();
                if($save) {
                    $_SESSION['register'] = "complete";
                    // echo "El registro se ha realizado correctamente";
                }else {
                    $_SESSION['register'] = "failed";
                    // echo "registro fallido";
                }
                // para comprobar que todos los datos lleguen bien utilizamos un vardump
                // var_dump($usuario); 
                // die();
            }else {
                $_SESSION['register'] = "failed";
            }
        }else {
            $_SESSION['register'] = "failed";
        }
        header("Location:".base_url.'usuario/registro');
    }

    public function login() {
        if(isset($_POST)) {
            //identificar el usuario
            //Consulta a la base de datos 
            $usuario = new usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);    

            //Devuelve un objeto con el usuario identificado
            $identity = $usuario->login();

            // var_dump($identity);
            // die();

            if($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;

                // var_dump($_SESSION['identity']);
                // die();

                if($identity->rol == "admin") {
                    $_SESSION['admin'] = true;
                }
            }else {
                $_SESSION['error_login'] = "Identificación fallida";
            }

            //Crear sesion para guardar ese usuario
        }
        header("Location:".base_url);
    }

    public function logout() {
        if(isset($_SESSION['identity'])) {
            unset($_SESSION['identity']); 
        }

        if(isset($_SESSION['admin'])) {
            unset($_SESSION['admin']); 
        }

        header("Location:".base_url);
    }

}//FIN CLASE USUARIO