<?php 
namespace model;

/**
 * 
 */
class facturas{

	private $nombre;
	private $fecha;
	private $subtotal;
	private $iva;
	private $total;
	private $idFactura;
	private $resultPDF;
	
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

	public function guardarFactura(){
		$status = false;

		$this->con->autocommit(false);

		$query="INSERT INTO FACTURAS(FOLIO, FECHA_FACTURA,SUBTOTAL,IVA,TOTAL) VALUES('$this->nombre','$this->fecha',$this->subtotal,$this->iva,$this->total);";

		$this->con->insertar($query);

		$status = $this->con->check();

		$idFac = $this->con->ultimo_id();

		$this->con->send($status);

		return $idFac;
	}

	public function guardadFactTon($idTon,$idFac,$cantidad){

		$query="INSERT INTO FACTURA_TONERS(ID_TONER,ID_FACTURA,CANTIDAD) VALUES($idTon,$idFac,$cantidad);";

		$this->con->insertar($query);
		
	}

	public function detalle(){
		$query="SELECT ID_FACTURA,FOLIO, DATE_FORMAT(FECHA_FACTURA, '%d/%M/%Y') AS FECHA_FACTURA,FILE_FACTURA 
				FROM facturas
				ORDER BY ID_FACTURA DESC;";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function actualizarPDF(){
		$status = false;

		$this->con->autocommit(false);

		$query="UPDATE FACTURAS SET FILE_FACTURA='$this->resultPDF' WHERE ID_FACTURA=$this->idFactura;";

		$this->con->insertar($query);

		$status = $this->con->check();

		$this->con->send($status);

		return $status;
	}

	public function consultarFactura($id){
		$query = "SELECT ID_FACTURA,FOLIO, DATE_FORMAT(FECHA_FACTURA, '%d/%M/%Y') AS FECHA_FACTURA,FILE_FACTURA, DATE_FORMAT(NOW(),'%d/%M/%Y') AS FECHA, SUBTOTAL, IVA, TOTAL FROM FACTURAS WHERE ID_FACTURA=$id";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function facturasToners($id){
		$query="SELECT CONCAT(t.NOMBRE,'  ',t.MODELO,' ',t.DESCRIPCION) AS NOMBRE, ft.CANTIDAD FROM factura_toners AS ft, toner AS t WHERE ft.ID_TONER=t.ID_TONER AND ID_FACTURA=$id";

		$rs = $this->con->consultar($query);

		return $rs;
	}
}


?>