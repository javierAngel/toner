<?php 
namespace model;

/**
 * 
 */
class impresoras{
	
	private $nombre;
	private $modelo;
	private $multicolor;
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

	public function guardarImpresora($idToner){
		$status = false;

		$this->con->autocommit(false);

		$query="INSERT INTO IMPRESORAS(NOMBRE, MODELO,MULTICOLOR) VALUES('$this->nombre','$this->modelo',$this->multicolor);";

		$this->con->insertar($query);

		$status = $this->con->check();

		if ($idToner!=0) {
			$idImp = $this->con->ultimo_id();

			$query1="INSERT INTO IMPRESORAS_TONERS(ID_IMPRESORA,ID_TONER) VALUES($idImp,$idToner)";

			$this->con->insertar($query1);
		}

		$status = $this->con->check();

		$this->con->send($status);

		return $status;
	}

	public function consultarImpresorasToner(){
		$query="SELECT i.ID_IMPRESORA,i.NOMBRE,i.MODELO,t.ID_TONER,CONCAT(t.NOMBRE,' - ',t.MODELO,' - ',t.DESCRIPCION) AS TONERS,t.EXISTENCIA
				FROM impresoras AS i
				LEFT OUTER JOIN impresoras_toners AS it ON i.ID_IMPRESORA=it.ID_IMPRESORA
				LEFT OUTER JOIN toner AS t ON it.ID_TONER=t.ID_TONER
				WHERE i.MULTICOLOR=0";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function consultarImpresoras(){
		$query="SELECT i.ID_IMPRESORA,i.NOMBRE,i.MODELO,t.ID_TONER,CONCAT(t.NOMBRE,' - ',t.MODELO,' - ',t.DESCRIPCION) AS TONERS,t.EXISTENCIA
				FROM impresoras AS i
				LEFT OUTER JOIN impresoras_toners AS it ON i.ID_IMPRESORA=it.ID_IMPRESORA
				LEFT OUTER JOIN toner AS t ON it.ID_TONER=t.ID_TONER
				";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function consultarImpresorasColor(){
		$query="SELECT i.ID_IMPRESORA,i.NOMBRE,i.MODELO
				FROM impresoras AS i
				WHERE i.MULTICOLOR<>0
				ORDER BY i.ID_IMPRESORA";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function consultarImpresorasColorToner(){
		$query="SELECT i.ID_IMPRESORA,i.NOMBRE,i.MODELO,t.ID_TONER,CONCAT(t.NOMBRE,' - ',t.MODELO,' - ',t.DESCRIPCION) AS TONERS,t.EXISTENCIA
				FROM impresoras AS i
				LEFT OUTER JOIN impresoras_toners AS it ON i.ID_IMPRESORA=it.ID_IMPRESORA
				LEFT OUTER JOIN toner AS t ON it.ID_TONER=t.ID_TONER
				WHERE i.MULTICOLOR<>0
				ORDER BY i.ID_IMPRESORA";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function consultarImp($id){
		$query="SELECT *
				FROM impresoras AS i
				LEFT OUTER JOIN impresoras_toners AS it ON i.ID_IMPRESORA=it.ID_IMPRESORA
				WHERE i.ID_IMPRESORA=$id";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function editarImpresora($id,$idToner){
		$status = true;

		$this->con->autocommit(false);

		$msg = array();

		$consulta = array();

		$msgConsulta = array();

		$lon=count($idToner);

		$query="UPDATE IMPRESORAS SET NOMBRE='$this->nombre', MODELO='$this->modelo' where ID_IMPRESORA=$id;";

		$this->con->insertar($query);

		$status = $this->con->check();

		for ($i=0; $i < $lon; $i++) {
			$consult="SELECT * FROM IMPRESORAS_TONERS WHERE ID_IMPRESORA=$id AND ID_TONER=$idToner[$i];";
			$rs = $this->con->consultar($consult);
			$rs=mysqli_fetch_assoc($rs);
			if (count($rs)==0) {
				$query1="INSERT INTO IMPRESORAS_TONERS(ID_IMPRESORA,ID_TONER) VALUES($id,$idToner[$i])";

				$this->con->insertar($query1);

				$status = $this->con->check();
			}
		}
		$this->con->send($status);

		return $status;

		// $status = false;

		// $this->con->autocommit(false);

		// $query="UPDATE IMPRESORAS SET NOMBRE='$this->nombre', MODELO='$this->modelo' where ID_IMPRESORA=$id;";

		// $this->con->insertar($query);

		// $status = $this->con->check();

		// $query1="UPDATE IMPRESORAS_TONERS SET ID_IMPRESORA=$id, ID_TONER=$idToner WHERE ID_IMP_TON=$idImpTon";

		// $this->con->insertar($query1);

		// $status = $this->con->check();

		// $this->con->send($status);

		// return $status;
	}

	public function eliminarTonImp($idImp,$idTon){
		$status = true;

		$this->con->autocommit(false);

		$query="DELETE FROM IMPRESORAS_TONERS WHERE ID_IMPRESORA=$idImp AND ID_TONER=$idTon";

		$this->con->insertar($query);

		$status = $this->con->check();

		$this->con->send($status);

		return $status;
	}
}


?>