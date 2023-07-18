<?php
namespace model;
/**
 *
 */
class surtimiento{
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

	public function consultarDetalle(){
		$query="SELECT s.ID_SURTIMIENTO,DATE_FORMAT(s.FECHA_SURTIMIENTO,'%d/%M/%Y %r') AS FECHA,CONCAT(t.NOMBRE,', ',t.MODELO,', ',t.DESCRIPCION) AS TONERS, ds.CANTIDAD, CONCAT(a.NOMBRE,', ', ds.NOMBRE_ALMACEN) AS ALMACENS, 		CONCAT(p.NOMBRE,' ',p.APELLIDO_PAT,' ',p.APELLIDO_MAT) AS PERSONA
				FROM detalle_surtimiento AS ds, toner AS t, usuarios AS u, almacen AS a, surtimiento AS s, personas AS p
				WHERE ds.ID_SURTIMIENTO=s.ID_SURTIMIENTO AND ds.ID_TONER=t.ID_TONER AND ds.ID_USUARIO=u.ID_USUARIO AND ds.ID_ALMACEN=a.ID_ALMACEN AND u.ID_PERSONA=p.ID_PERSONA
				ORDER BY s.ID_SURTIMIENTO DESC
			LIMIT 100";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function guardarSurtimiento($idToner,$idUsuario,$idAlmacen,$cantidad,$existencia,$fecha,$nombreAlmacen){

		$status = false;

		$this->con->autocommit(false);

		$query="INSERT INTO SURTIMIENTO(FECHA_SURTIMIENTO) VALUES($fecha);";

		$this->con->insertar($query);

		$status = $this->con->check();

		$idSurt=$this->con->ultimo_id();

		$query1="INSERT INTO DETALLE_SURTIMIENTO(ID_SURTIMIENTO,ID_TONER,ID_USUARIO,ID_ALMACEN,CANTIDAD,NOMBRE_ALMACEN) VALUES ($idSurt,$idToner,$idUsuario,$idAlmacen,$cantidad,'$nombreAlmacen')";

		$this->con->insertar($query1);

		$status = $this->con->check();

		$query2="UPDATE TONER SET EXISTENCIA=$existencia WHERE ID_TONER=$idToner;";

		$this->con->insertar($query2);

		$status = $this->con->check();

		$this->con->send($status);

		$result = array();

		$result[1]=$status;
		$result[2]=$idSurt;

		return $result;
	}

	public function surtimientoPDF($id){
		$query="SELECT ds.CANTIDAD, DATE_FORMAT(s.FECHA_SURTIMIENTO, '%d/%M/%Y %r') AS FECHA, CONCAT(t.NOMBRE,', ',t.DESCRIPCION) AS TONERS,t.NOMBRE AS MODELO,CONCAT(a.NOMBRE,'/',ds.NOMBRE_ALMACEN) AS ALMACENS,a.NOMBRE AS ALMACENNOMBRE, CONCAT(p.NOMBRE,' ',p.APELLIDO_PAT,' ',p.APELLIDO_MAT) AS USUARIO, CONCAT(i.NOMBRE,' ',i.MODELO) AS IMPRESORA
				FROM detalle_surtimiento AS ds, surtimiento AS s, usuarios AS u, almacen AS a, toner AS t, personas AS p, impresoras AS i, impresoras_toners AS it
				WHERE ds.ID_SURTIMIENTO=s.ID_SURTIMIENTO AND ds.ID_TONER=t.ID_TONER AND ds.ID_USUARIO=u.ID_USUARIO AND ds.ID_ALMACEN=a.ID_ALMACEN AND u.ID_PERSONA=p.ID_PERSONA AND it.ID_IMPRESORA=i.ID_IMPRESORA AND it.ID_TONER=t.ID_TONER AND ds.ID_SURTIMIENTO=$id";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function reporteTonersPDF($inicio,$fin,$alm,$ton){
		if ($alm==0) {
			$alm="";
		}else{
			$alm="AND a.ID_ALMACEN=".$alm;
		}
		if ($ton==0) {
			$ton="";
		}else{
			$ton="AND t.ID_TONER=".$ton;
		}
		if ($inicio=="") {
			$inicio="DATE_FORMAT(NOW(),'%Y-%m-%d 00:00:00')";
		}else{
			$inicio="'".$inicio." 00:00:00'";
		}
		if ($fin=="") {
			$fin="DATE_FORMAT(NOW(),'%Y-%m-%d 23:59:59')";
		}else{
			$fin="'".$fin." 23:59:59'";
		}
		$query="SELECT s.ID_SURTIMIENTO,CONCAT(a.NOMBRE,' - ',a.LOCALIZACION) AS ALMACENS,CONCAT(p.NOMBRE,' ',p.APELLIDO_PAT,' ',p.APELLIDO_MAT) AS PERSONA,CONCAT(t.NOMBRE,' - ',t.DESCRIPCION) AS TONERS,ds.CANTIDAD,DATE_FORMAT(s.FECHA_SURTIMIENTO, '%d/%M/%Y %r') AS FECHA
				FROM detalle_surtimiento AS ds
				LEFT OUTER JOIN surtimiento AS s ON ds.ID_SURTIMIENTO=s.ID_SURTIMIENTO
				LEFT OUTER JOIN toner AS t ON ds.ID_TONER=t.ID_TONER
				LEFT OUTER JOIN usuarios AS u ON ds.ID_USUARIO=u.ID_USUARIO
				LEFT OUTER JOIN personas AS p ON u.ID_PERSONA=p.ID_PERSONA
				LEFT OUTER JOIN almacen AS a ON ds.ID_ALMACEN=a.ID_ALMACEN
				WHERE s.FECHA_SURTIMIENTO BETWEEN ($inicio) AND ($fin)
				$alm
				$ton
				ORDER BY s.FECHA_SURTIMIENTO";

		$rs = $this->con->consultar($query);

		return $rs;
	}
}
?>
