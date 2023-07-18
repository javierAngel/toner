<?php 
	namespace controller;

	include_once "../conf/autoload.php";
	\conf\Autoload::run();

	$con = new \model\conexion();

	$user = new \model\usuarios($con);

	session_start();

	if($_POST['login'] == "Entrar"){
		
		$user->set("correo",$_POST['email']);
		$user->set("pass", $_POST['pass']);

		$rs = $user->login();
		$data = mysqli_fetch_assoc($rs);

		if(isset($data['ID_USUARIO'])){
			$_SESSION['nombreUsuario'] = $data['NOMBRE'];
			$_SESSION['apellidosUsuario'] = $data['APELLIDO_PAT'].' '.$data['APELLIDO_MAT'];
			$_SESSION['usuario'] = $data['ID_USUARIO'];
			$_SESSION['email'] = $data['EMAIL'];
			$_SESSION['ultimoAcceso'] = date("Y-n-j H:i:s");

			header("Location: ../view/principal.php");
		}else{
			$error = 'Usuario o contraseña incorrectos!';
            $_SESSION['error'] = $error;
			header("Location: ../view/login.php");
		}

		/*
		//codigo para codificar el password hash_hmac(); clave secreta mikitrc
		$user->set("foto","");
		$user->set("email","mavher78@hotmail.com");
		$user->set("pass", hash_hmac("sha512", "mikitrc123" , $secret));

		$user->insertar_usuarios(2,1);
		*/
	}

	if ($_POST['login'] == "confirmar") {
		$user->set("correo",$_SESSION['email']);
		$user->set("pass", $_POST['confirmacion']);

		$rs = $user->login();
		$data = mysqli_fetch_assoc($rs);
		if(isset($data['ID_USUARIO'])){
			$data=true;
		}else{
			$data=false;
		}
		echo json_encode($data);
	}
?>