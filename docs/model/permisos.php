<?php

namespace model;

/**
 * 
 */
class permisos
{
	private $CU;
	private $CU_1;
	private $CU_2;
	private $CU_2_1;
	private $CU_2_2;
	private $CU_2_3;
	private $CU_2_4;
	private $CU_3;
	private $US_PE;
	private $US_PE_1;
	private $US_PE_1_1;
	private $US_PE_1_2;
	private $US_PE_1_3;
	private $US_PE_1_4;
	private $US_PE_1_5;
	private $clave;
	private $descripcion;

	private $con;

	public function __construct($con)
	{
		$this->con = $con;
	}

	public function get($atributo){

		return $this->$atributo;

	}

	public function set($atributo, $parametro){

		$this->$atributo = $parametro;

	}

	public function permisoUsuario($valoresCheck,$id){
		$status = true;

		$this->con->autocommit(false);

		$msg = array();

		$consulta = array();

		$msgConsulta = array();

		$v=0;
		for ($i=0; $i < 69; $i++) {
			$v++;
			$consult="SELECT * FROM PERMISOS_USUARIOS WHERE ID_USUARIO=$id AND ID_PERMISO=$v;";
			$rs = $this->con->consultar($consult);
			$rs=mysqli_fetch_assoc($rs);
			if (isset($rs)) {
				$array = array_search("$v", $valoresCheck);
				if (!($valoresCheck[$array]=="$v")) {
					$query="DELETE FROM PERMISOS_USUARIOS WHERE ID_USUARIO=$id AND ID_PERMISO=$v;";

					$this->con->insertar($query);

					$status = $this->con->check();

					array_push($consulta, $status);
				}else{
					array_push($consulta, true);
				}
			}else{
				$array = array_search("$v", $valoresCheck);
				if ($valoresCheck[$array]=="$v") {
					$query="INSERT INTO PERMISOS_USUARIOS(ID_USUARIO,ID_PERMISO) VALUES($id,$v);";

					$this->con->insertar($query);

					$status = $this->con->check();

					array_push($consulta, $status);
				}else{
					array_push($consulta, true);
				}
			}

			if ($consulta[$i]) {

				array_push($msgConsulta, "BIEN");

			} else {

				array_push($msgConsulta, $query);

			}
		}
		
		$this->con->send($status);

		$msg = array(

					"status"    => $status,

				    "consulta" => $msgConsulta

				);

		return $msg;
	}

	public function consultarPermisos(){
		$query="SELECT * FROM PERMISOS";
		$rs = $this->con->consultar($query);
		return $rs;
	}

	public function addPermiso(){
		$status = true;

		$this->con->autocommit(false);

		$query="INSERT INTO PERMISOS(CLAVE,DESCRIPCION) VALUES('$this->clave','$this->descripcion');";

		$this->con->insertar($query);

		$status = $this->con->check();

		$this->con->send($status);

		return $status;
	}

	public function consultPermiso($id){
		$query="SELECT * FROM PERMISOS WHERE ID_PERMISO=$id;";
		$rs = $this->con->consultar($query);
		return $rs;
	}

	public function editPermiso($id){
		$status = true;

		$this->con->autocommit(false);
		
		$query="UPDATE PERMISOS SET CLAVE='$this->clave', DESCRIPCION='$this->descripcion' WHERE ID_PERMISO=$id;";

		$this->con->insertar($query);

		$status = $this->con->check();

		$this->con->send($status);

		return $status;
	}
}
 ?>