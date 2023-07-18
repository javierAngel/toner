<?php 
namespace controller;
	include_once "../conf/autoload.php";
	\conf\Autoload::run();
	
	$con = new \model\conexion();

	if ($_POST['accion']=='user') {
		$usuario = new \model\usuarios($con);

		$rs=$usuario->mostrarTipoUser();

		$info = array();
		while ($i = mysqli_fetch_assoc($rs)) {
			$info[$i['ID_TIPO']] = $i['NOMBRE'];
		}

		echo json_encode($info);
	}

	if ($_POST['accion']=='save') {
		$usuario = new \model\usuarios($con);

		$usuario->set('nombre',$_POST['nombre']);
		$usuario->set('apellidoPat',$_POST['apellidoPat']);
		$usuario->set('apellidoMat', $_POST['apellidoMat']);
		$usuario->set('correo',$_POST['correo']);
		$usuario->set('genero',$_POST['genero']);
		$usuario->set('pass',$_POST['pass']);

		$rs=$usuario->guardarUser();

		echo json_encode($rs);
	}

	if ($_POST['accion']=='estado') {
		$usuario = new \model\usuarios($con);

		$rs=$usuario->cambiarEstado($_POST['id_usuario'],$_POST['cambio']);

		echo json_encode($rs);
	}

	if ($_POST['accion']=='correo') {
		$usuario = new \model\usuarios($con);

		$rs=$usuario->enviarPass($_POST['id_usuario']);

		$info = array();
		while ($i = mysqli_fetch_assoc($rs)) {
			array_push($info, $i['EMAIL']);
			array_push($info, $i['pass']);
		}

		ini_set( 'display_errors', 1 );
	    error_reporting( E_ALL );
	    $from = "prueba@ms-cov19.com";
	    $to = $info[0];
	    $subject = "Reenvio de contrasena para el sistema MS-CoV19";
	    $message = "De acuerdo a la accion solicitada, la respuesta es la siguiente. La Contrasena actual es: ".$info[1];
	    $headers = "From:" . $from;
	    $rs=mail($to,$subject,$message, $headers);
	    $msg = array();
	    array_push($msg, $rs);
	    array_push($msg, $info[0]);
	    echo json_encode($msg);
	}

	if ($_POST['accion']=='pass') {
		$usuario = new \model\usuarios($con);

		$usuario->set('pass',$_POST['pass']);

		$rs=$usuario->cambioPass($_POST['id_usuario']);

		echo json_encode($rs);
	}

	if ($_POST['accion']=='consultUser') {
		$usuario = new \model\usuarios($con);

		$rs=$usuario->mostrarUsuarios($_POST['id_usuario']);

		$info = array();
		while ($i = mysqli_fetch_assoc($rs)) {
			$info['nombre'] = $i['NOMBRE'];
			$info['apellidoPat'] = $i['APELLIDO_PAT'];
			$info['apellidoMat'] = $i['APELLIDO_MAT'];
			$info['genero'] = $i['GENERO'];
			$info['correo'] = $i['EMAIL'];
			$info['id_persona'] = $i['ID_PERSONA'];
			$info['id_usuario'] = $i['ID_USUARIO'];
		}

		echo json_encode($info);
	}

  if ($_POST['accion']=='edit') {
    $usuario = new \model\usuarios($con);

    $usuario->set('nombre', $_POST['nombre']);
    $usuario->set('apellidoPat',$_POST['apellidoPat']);
    $usuario->set('apellidoMat', $_POST['apellidoMat']);
    $usuario->set('edad', $_POST['edad']);
    $usuario->set('curp',$_POST['curp']);
    $usuario->set('fechaNac',$_POST['fechaNac']);
    $usuario->set('cel',$_POST['celular']);
    $usuario->set('correo',$_POST['correo']);
    $usuario->set('genero', $_POST['genero']);
    $usuario->set('tipo', $_POST['tipo']);

    $rs=$usuario->editUser($_POST['id']);

    echo json_encode($rs);
  }

  if ($_POST['accion']=='consultPermiso') {
  	$usuario = new \model\usuarios($con);
  	$permisos = $usuario->mostrarPermisosUser($_POST['id_usuario']);

	$p = array();
	while($dp = $permisos->fetch_assoc()){
		$p[$dp['ID_PERMISO']] = true;
	}

	echo json_encode($p);
  }

  if($_POST['accion']=='addPermisoUsuario'){
  	$permiso = new \model\permisos($con);

  	$rs=$permiso->permisoUsuario($_POST['checks'],$_POST['id_usuario']);

  	echo json_encode($rs);
  }

  if ($_POST['accion']=='tipoUser') {
  	$usuario = new \model\usuarios($con);

  	$rs=$usuario->mostrarTipoUserId($_POST['id']);

  	$rs = mysqli_fetch_assoc($rs);

  	echo json_encode($rs);
  }

  if ($_POST['accion']=='guardarTipoUser') {
  	$usuario = new \model\usuarios($con);

  	$usuario->set('nombre',$_POST['nombre']);
  	$rs=$usuario->guardarTipoUser();

  	echo json_encode($rs);
  }

  if ($_POST['accion']=='editarTipoUser') {
  	$usuario = new \model\usuarios($con);

  	$usuario->set('nombre',$_POST['nombre']);
  	$rs=$usuario->editarTipoUser($_POST['id']);

  	echo json_encode($rs);
  }
?>