<?php 
namespace controller;
include_once "../conf/autoload.php";
\conf\Autoload::run();
	
$con = new \model\conexion();

if ($_POST['accion']=='guardar') {
	$impresora = new \model\impresoras($con);

	$impresora->set("nombre",$_POST['nombre']);
	$impresora->set("modelo",$_POST['modelo']);
	$impresora->set("multicolor",$_POST['multicolor']);

	$rs = $impresora->guardarImpresora($_POST['idToner']);

	echo json_encode($rs);
}

if ($_POST['accion']=='consultarImp') {
	$impresora = new \model\impresoras($con);

	$rs = $impresora->consultarImp($_POST['idImp']);

	$rs = mysqli_fetch_assoc($rs);

	echo json_encode($rs);
}

if ($_POST['accion']=='editarImpresora') {
	$impresora = new \model\impresoras($con);

	$impresora->set('nombre', $_POST['nombre']);
	$impresora->set('modelo', $_POST['modelo']);

	$rs = $impresora->editarImpresora($_POST['idImp'],$_POST['toner']);

	echo json_encode($rs);
}

if ($_POST['accion']=='llenarlist') {
	$impresora = new \model\impresoras($con);

	$rs = $impresora->consultarImpresorasToner();

	$imp = array();
	while($dat = mysqli_fetch_assoc($rs)){
		$imp[$dat['ID_IMPRESORA']]=$dat['NOMBRE'].' '.$dat['MODELO'];
	}

	echo json_encode($imp);
}

if ($_POST['accion']=='llenarlistTon') {
	$impresora = new \model\impresoras($con);

	$rs = $impresora->consultarImpresoras();

	$imp = array();
	while($dat = mysqli_fetch_assoc($rs)){
		$imp[$dat['ID_IMPRESORA']]=$dat['NOMBRE'].' '.$dat['MODELO'];
	}

	echo json_encode($imp);
}

if ($_POST['accion']=='llenarlistT') {
	$toner = new \model\toner($con);

	$rs = $toner->tonerExistenciaList();

	$ton = array();

	while($dat = mysqli_fetch_assoc($rs)){
		$ton[$dat['ID_TONER']]=$dat['NOMBRE'].' '.$dat['DESCRIPCION'];
	}

	echo json_encode($ton);
}

if ($_POST['accion']=='elimTonImp') {
	$impresora = new \model\impresoras($con);

	$rs = $impresora->eliminarTonImp($_POST['idImpresora'],$_POST['idToner']);

	echo json_encode($rs);
}

 ?>