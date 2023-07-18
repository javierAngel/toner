<?php 
namespace controller;
include_once "../conf/autoload.php";
\conf\Autoload::run();
	
$con = new \model\conexion();

if ($_POST['accion']=='almacen') {
	$almacen = new \model\almacen($con);

	$almacen->set('nombre',$_POST['nombre']);
	$almacen->set('localizacion', $_POST['localizacion']);

	$rs = $almacen->addAlmacen($_POST['idImp']);

	echo json_encode($rs);
}

if ($_POST['accion']=='consultarAlm') {
	$almacen = new \model\almacen($con);

	$rs = $almacen->consultarAlm($_POST['idAlm']);

	$rs = mysqli_fetch_assoc($rs);

	echo json_encode($rs);
}

if ($_POST['accion']=='editAlmacen') {
	$almacen = new \model\almacen($con);

	$almacen->set('nombre', $_POST['nombre']);
	$almacen->set('localizacion', $_POST['localizacion']);

	$rs = $almacen->editAlmacen($_POST['idAlm'],$_POST['idImp']);

	echo json_encode($rs);
}

if ($_POST['accion']=='consultAlm') {
	$almacen = new \model\almacen($con);

	$rs = $almacen->almacenes();

	$almacenes = array();
	while($r = mysqli_fetch_assoc($rs)){
		$almacenes[$r['ID_ALMACEN']]=$r['NOMBRE'].' - '.$r['LOCALIZACION'];
	}

	echo json_encode($almacenes);
}
 
if ($_POST['accion']=='listSurtimientos') {
	$almacen = new \model\almacen($con);

	$rs = $almacen->listSurtimientos($_POST['idAlm']);
	$ton = array();
	while ($r = mysqli_fetch_assoc($rs)) {
		$res = array();
		$res['ID']=$r['ID_TONER'];
		$res['NOMBRE']=$r['TONERS'];
		array_push($ton, $res);
	}
	echo json_encode($ton);
}
?>