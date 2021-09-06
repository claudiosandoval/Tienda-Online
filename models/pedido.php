<?php 

class pedido {
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;


    public function __construct()
    {
        $this->db = Database::connect();
    }

    


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of usuario_id
     */ 
    public function getUsuario_id()
    {
        return $this->usuario_id;
    }

    /**
     * Set the value of usuario_id
     *
     * @return  self
     */ 
    public function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;

        return $this;
    }

    /**
     * Get the value of provincia
     */ 
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set the value of provincia
     *
     * @return  self
     */ 
    public function setProvincia($provincia)
    {
        $this->provincia = $this->db->real_escape_string($provincia);

        return $this;
    }

    /**
     * Get the value of localidad
     */ 
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set the value of localidad
     *
     * @return  self
     */ 
    public function setLocalidad($localidad)
    {
        $this->localidad = $this->db->real_escape_string($localidad);

        return $this;
    }

    /**
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $this->db->real_escape_string($direccion);

        return $this;
    }

    /**
     * Get the value of coste
     */ 
    public function getCoste()
    {
        return $this->coste;
    }

    /**
     * Set the value of coste
     *
     * @return  self
     */ 
    public function setCoste($coste)
    {
        $this->coste = $this->db->real_escape_string($coste);

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $this->db->real_escape_string($estado);

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of hora
     */ 
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set the value of hora
     *
     * @return  self
     */ 
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    public function save() {
        $sql = "INSERT INTO pedidos VALUES(NULL, {$this->getUsuario_id()}, '{$this->getProvincia()}', '{$this->getLocalidad()}', '{$this->getDireccion()}', {$this->getCoste()}, 'confirm', CURDATE(), CURTIME());";
        $save = $this->db->query($sql);

        // echo $this->db->error;
        // die();

        $result = false;
        if($save) {
            $result = true;
        }

        return $result;
    }

    public function updateOne() { //Metodo para actualizar el estado del pedido
        $sql = "UPDATE pedidos set estado = '{$this->getEstado()}' ";
        $sql .= "WHERE id = {$this->getId()}";

        // var_dump($sql); 
        // die();

        $update = $this->db->query($sql);

        
        // echo $this->db->error;
        // die();

        $result = false;
        if($update) {
            $result = true;
        }

        return $result;
    }

    public function getPedidos() { //Devuelve todos los pedidos     
        $pedidos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC;");

        return $pedidos;
    }

    public function getOnePedidoByUser() { //Retorna un pedido por usuario 
        $sql = "SELECT p.id, p.coste FROM pedidos p 
                                        INNER JOIN lineas_pedidos lp ON p.id = lp.pedido_id 
                                        INNER JOIN productos pr ON pr.id = lp.producto_id 
                                        WHERE p.usuario_id = {$this->getUsuario_id()}
                                        ORDER BY lp.id DESC LIMIT 1;";
        $pedido = $this->db->query($sql);     
        return $pedido->fetch_object();
    }

    public function getPedidosByUser() { //Retorna los pedidos por usuario con toda su informacion
        $sql = "SELECT p.* FROM pedidos p 
                                        INNER JOIN lineas_pedidos lp ON p.id = lp.pedido_id 
                                        INNER JOIN productos pr ON pr.id = lp.producto_id 
                                        WHERE p.usuario_id = {$this->getUsuario_id()}
                                        ORDER BY lp.id DESC;";
        $pedido = $this->db->query($sql);     
        return $pedido;
    }

    public function getProductosByPedidos($id) { //Devuelve todos los productos en base a un id de pedido
        // $sql = "SELECT * FROM productos
        //         WHERE id IN (SELECT producto_id FROM lineas_pedidos WHERE pedido_id = {$id});";

        //Realizamos esta consulta en vez de la primera ya que con esta segunda podemos sacar las unidades e imprimirlas en el pedido confirmado
        $sql = "SELECT pr.*, lp.unidades as unidades FROM productos pr 
                INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id
                WHERE lp.pedido_id = {$id};";

        $productos = $this->db->query($sql);     
        return $productos;
    }

    public function getDatosUsuario($id) {
        $sql = "SELECT CONCAT(u.nombre,' ', u.apellidos) as nombre, u.email FROM productos pr 
                INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id
                INNER JOIN pedidos p ON lp.pedido_id = p.id
                INNER JOIN usuarios u ON p.usuario_id = u.id
                WHERE lp.pedido_id = {$id}
                LIMIT 1;";

        $datos_usuario = $this->db->query($sql);     
        return $datos_usuario->fetch_object();
    }
    

    public function save_linea() { //Devuelve el id del pedido
        $sql = "SELECT LAST_INSERT_ID() as pedido";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;
        return $pedido_id;
    }

    public function getAllByUser() { //Retorna todos los pedidos adjuntos a un usuario en especifico
        $sql = "SELECT p.* FROM pedidos p 
                WHERE p.usuario_id = {$this->getUsuario_id()}
                ORDER BY p.id DESC;";
        $pedidos = $this->db->query($sql);     
        return $pedidos;
    }
}