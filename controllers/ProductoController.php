<?php 
require_once 'models/producto.php';
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
        Utils::isAdmin();
        // if(isset($_POST)) {
        //     var_dump($_POST);
        // }

        if(isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;

            if($nombre && $descripcion && $precio && $stock && $categoria) {
                require_once 'models/producto.php';

                $producto = new Producto();

                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);

                //Guardar imagen
                if(isset($_FILES['imagen'])) {
                    $file = $_FILES['imagen']; //guardamos en una variable el archivo imagen que llegara a la variable superglobal con el name del atributo del input
                    $filename = $file['name']; //variable que guarda el nombre del archivo
                    $mimetype = $file['type']; //recoge el formate de archivo (jpg, png, pdf, jpeg)
    
                    if($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') { //solo guardaremos la imagen si viene en los formatos correspondientes
    
                        if(!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true); //si no esta creada la carpeta, la creamos con los permisos correspondientes
                        }
    
                        move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                        $producto->setImagen($filename);
                    }
                }

                //Reutilizamos el metodo save para editar mediante una condicion la cual verifica si llega un parametro por get id, edita el producto de lo contrario lo guarda
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->edit();
                } else {
                    $save = $producto->save();
                }

                if($save) {
                    $_SESSION['producto'] = "complete";
                }else {
                    $_SESSION['producto'] = "failed";
                }
            }else {
                $_SESSION['producto'] = "failed";
            }
        }else {
            $_SESSION['producto'] = "failed";
        }

        // var_dump($_SESSION['producto']);
        // die();


        header("Location:".base_url."producto/gestion");    
    }

    public function eliminar() {
        Utils::isAdmin();

        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);
            $delete = $producto->delete();

            if($delete) {
                $_SESSION['delete'] = 'complete';
            }else {
                $_SESSION['delete'] = 'failed';
            }
        }else {
            $_SESSION['delete'] = 'failed';
        }
        // var_dump($_GET);

    header("Location:".base_url."producto/gestion");
    }

    public function editar() {
        Utils::isAdmin();
        // var_dump($_GET);
        if(isset($_GET['id'])) {
            $edit = true;
            $id = $_GET['id'];
            //cargar modelo 
            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOneProduct();

            require_once 'views/producto/crear.php';
        }else {
            header("Location:".base_url."producto/gestion");
        }

    }

}