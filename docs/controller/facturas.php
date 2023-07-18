<?php 
namespace controller;
include_once "../conf/autoload.php";
\conf\Autoload::run();
	
$con = new \model\conexion();

if ($_POST['accion']=='guardar') {
	$factura = new \model\facturas($con);
	$toner = new \model\toner($con);

	$factura->set("nombre", $_POST['factura']);
	$factura->set("fecha", $_POST['fechaFac']);
	$factura->set("subtotal", $_POST['subtotal']);
	$factura->set("iva", $_POST['iva']);
	$factura->set("total", $_POST['total']);
	$idFac = $factura->guardarFactura();

	$idTon = $_POST['idTon'];
	$cantidadTon = $_POST['cantidadTon'];
	session_start();
	$status=false;
	for ($i=0; $i < sizeof($idTon); $i++) {
		$idToner = $idTon[$i];
		$rs = $toner->consultExistenciaFactura($idToner); 
		$rs = mysqli_fetch_assoc($rs);
		$exist = $rs['EXISTENCIA']+$cantidadTon[$i];

		$factura->guardadFactTon($idToner,$idFac,$cantidadTon[$i]);

		$toner->set("existencia",$exist);
		$status = $toner->addExistencia($idToner,$_SESSION['usuario'],$cantidadTon[$i]);
	}

	echo json_encode($status);
}

if ($_POST['accion']=="subirFile") {
		if ($_FILES["file"]["type"] == "application/pdf") {
		    if (move_uploaded_file($_FILES["file"]["tmp_name"], "../facturas/".$_FILES['file']['name'])) {
		        $factura = new \model\facturas($con);

		        $factura->set('idFactura', $_POST['id_factura']);
		        $factura->set('resultPDF',$_FILES['file']['name']);

		        $rs=$factura->actualizarPDF();


		        echo json_encode($rs);
		    } else {
		        echo json_encode("ERROR-SERVER");
		    }
		} else {
		    echo json_encode("ARCHIVO-ERRONEO");
		}
	}
?>