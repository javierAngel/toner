<?php 
namespace controller;
include_once "../conf/autoload.php";
\conf\Autoload::run();
	
$con = new \model\conexion();

if ($_POST['accion']=='addToner') {
	$toner = new \model\toner($con);

	$toner->set('nombre',$_POST['nombre']);
	$toner->set('modelo',$_POST['modelo']);
	$toner->set('descripcion',$_POST['descripcion']);

	$rs = $toner->addToner();

	echo json_encode($rs);
}

if ($_POST['accion']=='agregarExistencia') {
	session_start();
	$inventToner = new \model\toner($con);
	$id=$_POST['idToner'];
	$existencia=$_POST['existencia'];
	$exist=$existencia;

	$exis=$inventToner->consultExistencia($id);
	$exis=mysqli_fetch_assoc($exis);

	$existencia+=$exis['EXISTENCIA'];

	$inventToner->set('existencia',$existencia);

	$rs=$inventToner->addExistencia($id,$_SESSION['usuario'],$exist);

	echo json_encode($rs);
}

if ($_POST['accion']=='consultarToner') {
	$toner = new \model\toner($con);
	$id=$_POST['idToner'];

	$detalleToner=$toner->consultExistencia($id);
	$detalleToner=mysqli_fetch_assoc($detalleToner);

	echo json_encode($detalleToner);

}

if ($_POST['accion']=='editToner') {
	$toner = new \model\toner($con);

	$toner->set('nombre',$_POST['nombre']);
	$toner->set('modelo',$_POST['modelo']);
	$toner->set('descripcion',$_POST['descripcion']);

	$rs = $toner->editToner($_POST['idToner']);

	echo json_encode($rs);
}

if ($_POST['accion']=='cancelarSurtimiento') {
	$toner = new \model\toner($con);

	$idDetalle = $_POST['idDetSurt'];

	$rs = $toner->detalleTonerID($idDetalle);
	$rs = mysqli_fetch_assoc($rs);

	$idToner = $rs['ID_TONER'];

	$exis=$toner->consultExistencia($idToner);
	$exis=mysqli_fetch_assoc($exis);

	$existencia;

	if ($exis['EXISTENCIA']>$rs['EXISTENCIA_AGREGADA']) {
		$existencia=$exis['EXISTENCIA']-$rs['EXISTENCIA_AGREGADA'];
	}else{
		$existencia=$rs['EXISTENCIA_AGREGADA']-$exis['EXISTENCIA'];
	}

	$toner->set('existencia',$existencia);

	$rs = $toner->cancelExistencia($idDetalle,$idToner);

	echo json_encode($rs);
}

if ($_POST['accion']=='consultTon') {
	$toner = new \model\toner($con);

	$rs = $toner->tonerExistencia();

	$toners = array();
	while($r = mysqli_fetch_assoc($rs)){
		$toners[$r['ID_TONER']]=$r['NOMBRE'].'-'.$r['MODELO'];
	}

	echo json_encode($toners);
}

if ($_POST['accion']=='salidaToner') {
	session_start();
	$inventToner = new \model\toner($con);
	$id=$_POST['idToner'];
	$existencia=$_POST['cantidad'];
	// $exist=$existencia;

	$exis=$inventToner->consultExistencia($id);
	$exis=mysqli_fetch_assoc($exis);

	$existencia=$exis['EXISTENCIA']-$existencia;

	$inventToner->set('existencia',$existencia);

	$rs=$inventToner->addExistencia($id,$_SESSION['usuario'],$existencia);

	echo json_encode($rs);
}

if ($_POST['accion']=='consultTonList') {
	$toner = new \model\toner($con);

	$rs = $toner->tonerExistenciaList();

	$toners = array();
	while($r = mysqli_fetch_assoc($rs)){
		$toners[$r['ID_TONER']]=$r['NOMBRE'].'-'.$r['MODELO'];
	}

	echo json_encode($toners);
}
?>