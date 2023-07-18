<?php 
namespace controller;
	include_once "../conf/autoload.php";
	\conf\Autoload::run();
	
	$con = new \model\conexion();

	if ($_POST['accion']=='permiso') {
		$permiso = new \model\permisos($con);

		$permiso->set('clave',$_POST['clave']);
		$permiso->set('descripcion',$_POST['descripcion']);

		$rs=$permiso->addPermiso();

		echo json_encode($rs);
	}

	if ($_POST['accion']=='consult') {
		$permiso = new \model\permisos($con);

		$rs=$permiso->consultPermiso($_POST['id_permiso']);

		$rs=mysqli_fetch_assoc($rs);

		echo json_encode($rs);
	}

	if ($_POST['accion']=='edit') {
		$permiso = new \model\permisos($con);

		$permiso->set('clave',$_POST['clave']);
		$permiso->set('descripcion',$_POST['descripcion']);
		$rs=$permiso->editPermiso($_POST['id_permiso']);

		echo json_encode($rs);
	}
 ?>