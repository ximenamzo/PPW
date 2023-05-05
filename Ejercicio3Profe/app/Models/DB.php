<?php
namespace Models;

class DB {
    public $db_host;
    public $db_name;
    private $db_user;
    private $db_passwd;

    public $conex;

    //Variables de control para las consultas

    public $s = " * ";
    public $w = " 1 ";

    public $r; //Resultado de la consulta

    public function __construct($dbh = "localhost",
                                $dbn = "blog",
                                $dbu = "root",$dbp = ""){
        $this->db_host = $dbh;
        $this->db_name = $dbn;
        $this->db_user = $dbu;
        $this->db_passwd = $dbp;
    }
    public function db_connect(){
        $this->conex = new \mysqli($this->db_host,
                                    $this->db_user,
                                    $this->db_passwd,
                                    $this->db_name);
        $this->conex->set_charset("utf8");
        if($this->conex->connect_error){
            echo "Falló la conexión a la base de datos";
        }else{
            return $this->conex;
        }
    }

    public function select($cc = []){
        if(count($cc) > 0){
            $this->s = implode(",",$cc);
        }
        return $this;
    }

    public function where($ww = []){
        $this->w = "";
        if(count($ww) > 0){
            foreach($ww as $wheres){
                $this->w .= $wheres[0] . " like '" . $wheres[1] . "' " . ' and ';
            }
        }
        $this->w .= ' 1 ';
        return $this;
    }

    public function get(){
        $sql = "select " . $this->s . 
                    " from " . str_replace("Models\\","",get_class($this)) . 
                    " where " . $this->w;
        $this->r = $this->table->query($sql);
        $result = [];
        while( $f = $this->r->fetch_assoc()){
            $result[] = $f;
        }
        return json_encode($result);
    }

        
}

