<?php

namespace model;

/**
 * 
 */
class almacen
{
	private $nombre;
	private $localizacion;

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

	public function almacenes(){
		$query="SELECT a.ID_ALMACEN,a.NOMBRE,a.LOCALIZACION, i.ID_IMPRESORA, CONCAT(i.NOMBRE,' ',i.MODELO) AS IMPRESORA
				FROM almacen AS a
				LEFT OUTER JOIN impresoras AS i ON a.ID_IMPRESORA=i.ID_IMPRESORA";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function addAlmacen($idImp){
		$status = false;

		$this->con->autocommit(false);

		$query="INSERT INTO ALMACEN(ID_IMPRESORA,NOMBRE,LOCALIZACION) VALUES($idImp,'$this->nombre','$this->localizacion');";

		$this->con->insertar($query);

		$status = $this->con->check();

		$this->con->send($status);

		return $status;
	}

	public function consultarAlm($id){
		$query="SELECT * FROM ALMACEN WHERE ID_ALMACEN=$id";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function editAlmacen($id,$idImp){
		$status = false;

		$this->con->autocommit(false);

		$query="UPDATE ALMACEN SET NOMBRE='$this->nombre', LOCALIZACION='$this->localizacion',ID_IMPRESORA=$idImp where ID_ALMACEN=$id;";

		$this->con->insertar($query);

		$status = $this->con->check();

		$this->con->send($status);

		return $status;
	}

	public function listSurtimientos($id){
		$query="SELECT t.ID_TONER,CONCAT(t.NOMBRE,' - ',t.DESCRIPCION) AS TONERS
				FROM almacen AS a
				LEFT OUTER JOIN impresoras_toners AS it ON a.ID_IMPRESORA=it.ID_IMPRESORA
				LEFT OUTER JOIN toner AS t ON t.ID_TONER=it.ID_TONER
				WHERE a.ID_ALMACEN=$id AND t.EXISTENCIA>0";

		$rs = $this->con->consultar($query);

		return $rs;
	}
}
 ?>