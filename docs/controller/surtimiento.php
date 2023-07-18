<?php 
namespace controller;
include_once "../conf/autoload.php";
\conf\Autoload::run();
	
$con = new \model\conexion();

if ($_POST['accion']=='guardar') {
	session_start();

	$surt = new \model\surtimiento($con);
	$toner = new \model\toner($con);

	$id=$_POST['idToner'];
	$idAlmacen=$_POST['idAlmacen'];
	$existencia=$_POST['cantidad'];
	$fecha="'".$_POST['fechaSurt']."'";
	if ($fecha=="''") {
		$fecha="NOW()";
	}

	$exis=$toner->consultExistenciaSurtimiento($id,$idAlmacen);
	$exis=mysqli_fetch_assoc($exis);
	$exist=$exis['EXISTENCIA'];

	if ($exist<$existencia) {
		echo json_encode(false);
	}else{
		$exist-=$existencia;
		$rs = $surt->guardarSurtimiento($id,$_SESSION['usuario'],$idAlmacen,$existencia,$exist,$fecha,$exis['LOCALIZACION']);
		echo json_encode($rs);
	}
	
}

?>