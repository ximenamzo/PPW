<?php 

namespace Models;
class interactions extends DB {
	public $table;
	function __construct(){
		parent::__construct();
		$this->table = $this->db_connect();
	}

	protected $campos = ['userId', 'postId', 'tipo'];
	public $valores = [];
}