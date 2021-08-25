<?php 

class categoria {
    private $id;
    private $nombre;
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
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);

        return $this;
    }

    public function getCategorias() {
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");

        return $categorias;
    }

    public function getOneCategoria() {
        $categoria = $this->db->query("SELECT * FROM categorias WHERE id = {$this->getId()} ORDER BY id DESC;");

        return $categoria->fetch_object(); //Retornamos la unica categoria como un objeto
    }

    public function save() {
        $sql = "INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}');";
        $save = $this->db->query($sql);
        $result = false;
        if($save) {
            $result = true;
        }

        return $result;
    }
}