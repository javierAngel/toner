<?php
	namespace model;

	/**
	*  conexion a la bd pv-gil-web
	*/
	class conexion{

		private $datos = array(
			'host'=>"localhost",
			'user'=>"root",
			'pass'=>"sumimsa2022",
			'db'=>"sistematoner"
			);

		private $con;

		public  function __construct(){
			$this->con=new \mysqli($this->datos['host'],$this->datos['user'],$this->datos['pass'],$this->datos['db']);
			if($this->con->error){
				echo 'Error de conexion'.$this->con->error;
				exit();
			}
		}

		public function check(){
			if ($this->con->errno){
				return false;
			}else{
				return true;
			}
		}

		public function send($status){
			if ($status) {
				$this->con->commit();
				return true;
			} else {
				$this->con->rollback();
				return false;
			}
		}

		public function autocommit($status){
			$this->con->autocommit($status);
		}

		public function insertar($sql){
			$es="SET lc_time_names = 'es_ES';";
			$this->con->query($es);

			$utc="SET @@session.time_zone = '-05:00';";
			$this->con->query($utc);

			$this->con->query($sql);
		}
		public function consultar($sql){
			$es="SET lc_time_names = 'es_ES';";
			$this->con->query($es);

			$utc="SET @@session.time_zone = '-05:00';";
			$this->con->query($utc);

			$datos=$this->con->query($sql);
			return $datos;
		}
		public function ultimo_id(){
			return $this->con->insert_id;
		}
		public function __destruct(){
			$this->con->close();
		}
	}

?>
