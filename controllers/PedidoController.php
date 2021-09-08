<?php 
require_once 'models/pedido.php';
require_once 'models/lineaPedido.php';
require_once 'models/producto.php';

class PedidoController {
    public function realizar() {
        // echo "Controlador pedido, Accion index";

        require_once 'views/pedido/realizar.php';

        
    }

    public function add() {
        // var_dump($_POST);   
        if(isset($_SESSION['identity'])) {
            //Guardar datos en la bd

            $usuario_id = $_SESSION['identity']->id;
            
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            
            $stats =  utils::statsCarrito(); //Stats del carrito, funcion que retorna un array del carrito de la session
            $coste = $stats['total'];
            $unidades = $stats['count'];

            //Guardar pedido con los valores seteados
            if($provincia && $localidad && $direccion && $coste && $usuario_id) {
                $pedido = new pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);
                
                // var_dump($pedido);  
                // die();

                
                $save = $pedido->save();
                
                //GUARDAR LINEA PEDIDO
                $pedido_id = $pedido->save_linea(); //Retorna el id del ultimo pedido
                // var_dump($pedido_id);
                // die();
                $linea_pedido = new lineaPedido();

                foreach ($_SESSION['carrito'] as $key => $value) {
                    $linea_pedido->setPedido_id($pedido_id);
                    $linea_pedido->setUnidades($value['unidades']);
                    $linea_pedido->setProducto_id($value['producto']->id);
                    $save_linea = $linea_pedido->save();  

                    //Actualizar Stock del producto que ya fue comprado

                    $producto = new Producto();
                    $producto->setId($value['producto']->id);
                    $productos = $producto->getProductosById();     //Retorna todos los pedidos donde el id coincida
                    
                    while($pro = $productos->fetch_object()) {
                        //Recogemos el id de la session actual del carrito y lo seteamos al objeto
                        //Restamos el stock al stock real del producto con el de la sesion del carrito a comprar
                        $unidades_final = $pro->stock - $value['unidades'];
                        $producto->setId($pro->id); 
                        $producto->setStock($unidades_final);
                        $producto->updateStock();      
                    }
                }


                if($save && $save_linea) {
                    $_SESSION['pedido'] = "complete";
                    Utils::deleteSession('carrito');
                    // var_dump($_SESSION['pedido']);
                }else {
                    // var_dump($_SESSION['pedido']);
                    $_SESSION['pedido'] = "failed";
                } 
            }else {
                $_SESSION['pedido'] = "failed";
            }

            header("Location:".base_url."pedido/confirmado");

        }else {
            header("Location:".base_url);
        }
        
    }

    public function confirmado() {

        if(isset($_SESSION['identity'])) {
            $identity = $_SESSION['identity'];
            $pedido = new pedido();
            $pedido->setUsuario_id($identity->id);
            $pedido = $pedido->getOnePedidoByUser(); //Devuelve el ultimo pedido realizado por el usuario identificado

            $pedido_productos = new pedido();
            $productos = $pedido_productos->getProductosByPedidos($pedido->id); //Contiene el resultset de la base de datos con todos los productos correspondientes a este pedido
        }

        require_once 'views/pedido/confirmado.php';
    }

    public function mis_pedidos() {

        //Obtener todos los pedidos del usuario identificado
        Utils::isIdentity();
        $pedido = new pedido();
        $pedido->setUsuario_id($_SESSION['identity']->id);
        $pedidos = $pedido->getAllByUser();    

        //Obtener todos los productos aninados al pedido del usuario identificado (Se mostraran en un modal)
        // $pedido_id = $pedido->getOnePedidoByUser($_SESSION['identity']->id);
        // $pedido_producto = $pedido->getProductosByPedidos();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function detalle() { //En mis pedidos al presionar un numero de pedido se redirecciona al detalle de ese pedido de cada usuario
        Utils::isIdentity();

        $pedido = new pedido();
        
        if(isset($_GET['id'])) {
            $id_pedido = $_GET['id'];

            //Obtener los datos del pedido
            $pedido = new pedido();
            $pedido_productos = $pedido->getProductosByPedidos($id_pedido);

        }else {
            header("Location:".base_url.'pedido/mis_pedidos');
        }

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function gestion() {
        Utils::isAdmin();
        
        $gestion = true;

        $pedido = new pedido();
        $pedidos = $pedido->getPedidos();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function estado() {
        Utils::isAdmin();

        if(isset($_POST['pedido_id']) && isset($_POST['estado'])) {

            //Recoger los datos necesarios para el update
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];
            
            //Update del pedido
            $pedido = new pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->updateOne();

            header("Location:".base_url."pedido/gestion");  
        }else {
            header("Location:".base_url);
        }
    }
}