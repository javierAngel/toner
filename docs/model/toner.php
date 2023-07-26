<?php 
namespace model;

/**
 * 
 */
class toner
{
	
	private $nombre;
	private $modelo;
	private $descripcion;
	private $existencia;

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

	public function toners(){
		$query="SELECT * FROM TONER";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function tonerSinExistencia(){
		$query="SELECT * FROM TONER WHERE EXISTENCIA=0";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function tonerExistencia(){
		$query="SELECT * FROM TONER WHERE EXISTENCIA>0";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function tonerExistenciaList(){
		$query="SELECT * FROM TONER";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function detalleToner(){
		$query="SELECT de.ID_DET_EXIS,DATE_FORMAT(de.FECHA,'%d/%M/%Y %r') AS FECHA, CONCAT(p.NOMBRE,' ', p.APELLIDO_PAT,' ',p.APELLIDO_MAT) AS NOMBRE, t.NOMBRE AS TONERS, de.EXISTENCIA_AGREGADA,de.ESTADO
				FROM detalle_existencia AS de, usuarios AS u,toner AS t,personas AS p
				WHERE de.ID_USUARIO=u.ID_USUARIO AND de.ID_TONER=t.ID_TONER AND u.ID_PERSONA=p.ID_PERSONA
				ORDER BY de.ID_DET_EXIS DESC";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function addToner(){
		$status = false;

		$this->con->autocommit(false);

		$query="INSERT INTO TONER(NOMBRE,MODELO,DESCRIPCION,EXISTENCIA) VALUES('$this->nombre','$this->modelo','$this->descripcion',0);";

		$this->con->insertar($query);

		$status = $this->con->check();

		$this->con->send($status);

		return $status;
	}

	public function consultExistencia($id){
		// AND a.ID_ALMACEN=$idAlma
		$query="SELECT * FROM toner AS t WHERE ID_TONER=$id";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function consultExistenciaSurtimiento($id, $idAlma){
		// AND a.ID_ALMACEN=$idAlma
		$query="SELECT * FROM toner AS t, almacen AS a WHERE t.ID_TONER=$id AND a.ID_ALMACEN=$idAlma";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function consultExistenciaFactura($id){
		$query="SELECT * FROM toner AS t WHERE ID_TONER=$id";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function addExistencia($id,$idUsuario,$exist){
		$status = false;

		$this->con->autocommit(false);

		$query="UPDATE TONER SET EXISTENCIA=$this->existencia WHERE ID_TONER=$id;";

		$this->con->insertar($query);

		$status = $this->con->check();

		$query1="INSERT INTO DETALLE_EXISTENCIA(ID_USUARIO,ID_TONER,EXISTENCIA_AGREGADA,FECHA,ESTADO) VALUES($idUsuario,$id,$exist,NOW(),1);";

		$this->con->insertar($query1);

		$status = $this->con->check();

		$this->con->send($status);

		return $status;
	}

	public function editToner($id){
		$status = false;

		$this->con->autocommit(false);

		$query="UPDATE TONER SET NOMBRE='$this->nombre', MODELO='$this->modelo', DESCRIPCION='$this->descripcion' WHERE ID_TONER=$id;";

		$this->con->insertar($query);

		$status = $this->con->check();

		$this->con->send($status);

		return $status;
	}

	public function detalleTonerID($id){
		$query="SELECT de.ID_DET_EXIS,DATE_FORMAT(de.FECHA,'%d/%M/%Y %r') AS FECHA, CONCAT(p.NOMBRE,' ', p.APELLIDO_PAT,' ',p.APELLIDO_MAT) AS NOMBRE, t.NOMBRE AS TONERS,t.ID_TONER, de.EXISTENCIA_AGREGADA
				FROM detalle_existencia AS de, usuarios AS u,toner AS t,personas AS p
				WHERE de.ID_USUARIO=u.ID_USUARIO AND de.ID_TONER=t.ID_TONER AND u.ID_PERSONA=p.ID_PERSONA AND de.ID_DET_EXIS=$id";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function cancelExistencia($idSurt,$idTon){
		$status = false;

		$this->con->autocommit(false);

		$query="UPDATE TONER SET EXISTENCIA=$this->existencia WHERE ID_TONER=$idTon;";

		$this->con->insertar($query);

		$status = $this->con->check();

		$query1="UPDATE DETALLE_EXISTENCIA SET ESTADO=0 WHERE ID_DET_EXIS=$idSurt;";

		$this->con->insertar($query1);

		$status = $this->con->check();

		$this->con->send($status);

		return $status;
	}

	public function surtimientoToner($idTon){
		$status = false;

		$this->con->autocommit(false);

		$query="UPDATE TONER SET EXISTENCIA=$this->existencia WHERE ID_TONER=$idTon;";

		$this->con->insertar($query);

		$status = $this->con->check();
		
		$this->con->send($status);

		return $status;
	}

	public function cantidadTonersEntregados(){
		$query="SELECT CONCAT(a.NOMBRE,' - ',a.LOCALIZACION) AS ALMACENS, CONCAT(t.NOMBRE,' ',t.DESCRIPCION) AS TONERS, ds.CANTIDAD, COUNT(ds.CANTIDAD) AS CANTIDAD
				FROM detalle_surtimiento AS ds, surtimiento AS s, almacen AS a, toner AS t
				WHERE ds.ID_SURTIMIENTO=s.ID_SURTIMIENTO AND ds.ID_ALMACEN=a.ID_ALMACEN AND ds.ID_TONER=t.ID_TONER AND DATE_FORMAT(s.FECHA_SURTIMIENTO,'%c')=DATE_FORMAT(NOW(),'%c') AND DATE_FORMAT(s.FECHA_SURTIMIENTO,'%Y')=DATE_FORMAT(NOW(),'%Y')
				GROUP BY ALMACENS";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function addSalida($id,$idUsuario,$exist){
		$status = false;

		$this->con->autocommit(false);

		$query="UPDATE TONER SET EXISTENCIA=$this->existencia WHERE ID_TONER=$id;";

		$this->con->insertar($query);

		$status = $this->con->check();

		$query1="INSERT INTO salida(ID_TONER,DESCRIPCION,CANTIDAD) VALUES($id,$descripcion,);";

		$this->con->insertar($query1);

		$status = $this->con->check();

		$this->con->send($status);

		return $status;
	}
}
?>