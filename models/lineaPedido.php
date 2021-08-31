<?php 

class lineaPedido {

    private $id;
    private $pedido_id;
    private $producto_id;
    private $unidades;
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
     * Get the value of pedido_id
     */ 
    public function getPedido_id()
    {
        return $this->pedido_id;
    }

    /**
     * Set the value of pedido_id
     *
     * @return  self
     */ 
    public function setPedido_id($pedido_id)
    {
        $this->pedido_id = $pedido_id;

        return $this;
    }

    /**
     * Get the value of producto_id
     */ 
    public function getProducto_id()
    {
        return $this->producto_id;
    }

    /**
     * Set the value of producto_id
     *
     * @return  self
     */ 
    public function setProducto_id($producto_id)
    {
        $this->producto_id = $producto_id;

        return $this;
    }

    /**
     * Get the value of unidades
     */ 
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * Set the value of unidades
     *
     * @return  self
     */ 
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;

        return $this;
    }

    public function save() {

            $sql = "INSERT INTO lineas_pedidos VALUES(NULL, {$this->getPedido_id()}, {$this->getProducto_id()}, {$this->getUnidades()});";
            $save = $this->db->query($sql);
            $result = false;
            if($save) {
                $result = true;
            }
            return $result;



    }
}