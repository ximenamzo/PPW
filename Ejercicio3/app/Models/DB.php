<?php
	namespace Models;

	class DB{
		public $db_host;
		public $db_name;
		private $db_user;
		private $db_passwd;

        public $connect;

        //Variables - Atributos de control para las consutlas 
        public $s = " * "; //Select
        public $j = ""; // Join
        public $w = " 1 "; //Where
        public $o = ""; // Order by
        public $l = "";
        public $r; //Resultado de consulta

        public function __construct($dbh = "localhost", $dbn = "blog", $dbu="root", $dbp=""){
            $this->db_host=$dbh;
            $this->db_name=$dbn;
            $this->db_user=$dbu;
            $this->db_passwd=$dbp;
        }

        public function db_connect(){ 
            //mysqli lleva \ porque no es un objeto de nuestro proyecto, es parte del lenguaje
            $this->connect = new \mysqli($this->db_host,
									  $this->db_user,
									  $this->db_passwd,
									  $this->db_name);
            $this->connect->set_charset("utf8");
            if($this->connect->connect_errno){
                echo "Falló la conexión de la Base de Datos.";
            }else{
                return $this->connect;
            }
        }


        /// Consulta Select
        public function select($cc = []){
            if(count($cc) > 0){
                $this->s = implode(",", $cc);
            }
            return $this; //instacia de la instacia que estoy utilizando
        }

        public function join($join = "", $on = ""){
            if($join != "" && $on != ""){
                $this->j = ' join ' . $join . ' on ' . $on;
            }
            return $this;
        }

        /// Consulta Where
        public function where($ww = []){
			$this->w = "";
			if(count($ww) > 0){
				foreach($ww as $wheres){
					$this->w .= $wheres[0] . " like '" . $wheres[1] . "'" . " and ";
				}
			}
			$this->w.= '1';
			return $this;
		}

        public function orderBy($ob = []){
			$this->o = "";
			if(count($ob) > 0){
				foreach($ob as $orderBy){
					$this->o .= $orderBy[0] . ' ' . $orderBy[1] . ',';
				}
				$this->o = ' order by ' . trim($this->o, ',');
			}
			return $this;
		}

        public function limit($l = ""){
			$this->l = "";
			if($l != ""){
				$this->l = ' limit ' . $l;
			}
			return $this;
		}

        public function get(){
            $sql = "select " . $this->s .
				   " from " . str_replace("Models\\", "", get_class($this)) .
				   ($this->j != "" ? " a" . $this->j : "") .
				   " where " . $this->w .
				   $this->o . 
				   $this->l;
            $this->r = $this->table->query($sql);
            $result = [];
            while( $f = $this->r->fetch_assoc()){
                $result[] = $f;
            }
            return json_encode($result);
        }

        public function create(){
            $sql = "insert into " . str_replace("Models\\", "", get_class($this)) .
                    " (" . implode("," , $this->campos ) .') values (' . 
                    trim(str_replace("&","?,",str_pad("",count($this->campos),"&")),",") . ');'; // str pad es para rellenar <3
            $stmt = $this->table->prepare($sql);
            $stmt->bind_param(str_pad("",count($this->campos),"s"),...$this->valores);
            return $stmt->execute();
            // comilla simple mas rapida
            // comilla doble evalua variables
        }
    }

    // $objectDB = new DB();
    // $aux = $objectDB->db_connect();
    // var_dump($aux);