<?php 

namespace Models;
class posts extends DB {
	public $table;
	function __construct(){
		parent::__construct();
		$this->table = $this->db_connect();
	}

	protected $campos = ['userId', 'title', 'body'];
	public $valores = [];
}

    //vacio xq depende de lo que yo este haciendo