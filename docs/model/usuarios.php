<?php 

namespace model;



/**

 * 

 */

class usuarios

{

	private $nombre;
	private $apellidoMat;
	private $apellidoPat;
	private $edad;
	private $fechaNac;
	private $curp;
	private $cel;
	private $correo;
	private $genero;
	private $tipo;
	private $pass;
	private $cliente;

	private $con; 	

	public function __construct($con){

		$this->con = $con;

	}



	public function get($atributo){

		return $this->$atributo;

	}

	public function set($atributo, $parametro){

		$this->$atributo = $parametro;

	}

	public function login(){
			$query = "SELECT * FROM USUARIOS,PERSONAS WHERE EMAIL='$this->correo' AND PASSWORD=AES_ENCRYPT('$this->pass','SUM1MS@2O2I') AND USUARIOS.ID_PERSONA=PERSONAS.ID_PERSONA AND USUARIOS.ESTADO=1";
			$rs = $this->con->consultar($query);
			return $rs;
	}

	public function enviarPass($id){
		$query = "SELECT u.EMAIL, AES_DECRYPT(u.PASSWORD,'mayo17052020') AS pass FROM USUARIOS AS u WHERE ID_USUARIO=$id";
			$rs = $this->con->consultar($query);
			return $rs;
	}

	public function cambioPass($id){
		$status = true;

		$this->con->autocommit(false);

		$msg = array();



		$consulta = array();

		$msgConsulta = array();

		$query="UPDATE USUARIOS SET PASSWORD=AES_ENCRYPT('$this->pass','SUM1MS@2O2I')  WHERE ID_USUARIO=$id;";

		$this->con->insertar($query);

		$status = $this->con->check();

		array_push($consulta, $status);

		if ($consulta[0]) {

			array_push($msgConsulta, "BIEN");

		} else {

			array_push($msgConsulta, $query);

		}

		$this->con->send($status);

		$msg = array(

					"status"    => $status,

				    "consulta" => $msgConsulta,

				);

		return $msg;
	}

	public function mostrarPermisosUser($id){
		$query="SELECT pu.ID_PERMISO, p.DESCRIPCION, p.CLAVE FROM USUARIOS AS u 
			INNER JOIN PERMISOS_USUARIOS AS pu ON pu.ID_USUARIO=u.ID_USUARIO 
			INNER JOIN  PERMISOS AS p ON p.ID_PERMISO=pu.ID_PERMISO
			WHERE u.ID_USUARIO=".$id;
		$rs = $this->con->consultar($query);
		return $rs;
	}

	public function cambiarEstado($id,$estado){
		$status = true;

		$this->con->autocommit(false);

		$msg = array();



		$consulta = array();

		$msgConsulta = array();

		$query="UPDATE USUARIOS SET ESTADO=$estado WHERE ID_USUARIO=$id;";

		$this->con->insertar($query);

		$status = $this->con->check();

		array_push($consulta, $status);

		if ($consulta[0]) {

			array_push($msgConsulta, "BIEN");

		} else {

			array_push($msgConsulta, $query);

		}

		$this->con->send($status);

		$msg = array(

					"status"    => $status,

				    "consulta" => $msgConsulta,

				);

		return $msg;		
	}

	public function mostrarUser(){
		$query="SELECT u.ID_USUARIO,p.NOMBRE,p.APELLIDO_MAT,p.APELLIDO_PAT,u.EMAIL,u.ESTADO 
				FROM PERSONAS AS p, USUARIOS AS u
				WHERE p.ID_PERSONA=u.ID_PERSONA";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function guardarUser(){
		$status = true;

		$this->con->autocommit(false);

		$msg = array();



		$consulta = array();

		$msgConsulta = array();

		$query="INSERT INTO PERSONAS(NOMBRE,APELLIDO_MAT,APELLIDO_PAT,GENERO) VALUES('$this->nombre','$this->apellidoMat','$this->apellidoPat','$this->genero');";

		$this->con->insertar($query);

		$status = $this->con->check();

		array_push($consulta, $status);

		if ($consulta[0]) {

			array_push($msgConsulta, "BIEN");

		} else {

			array_push($msgConsulta, $query);

		}

		$usuario = $this->con->ultimo_id();

		$query1="INSERT INTO USUARIOS(ID_PERSONA,EMAIL,PASSWORD,ESTADO) VALUES($usuario,'$this->correo',AES_ENCRYPT('$this->pass','SUM1MS@2O2I'),1);";

		$this->con->insertar($query1);

		$status = $this->con->check();


		array_push($consulta, $status);

		if ($consulta[1]) {

			array_push($msgConsulta, "BIEN");

		} else {

			array_push($msgConsulta, $query1);

		}

		if ($consulta[0]) {
			if ($consulta[1]) {
				$this->con->send(true);

				$status=true;
			} else {
				$this->con->send(false);

				$status=false;
			}
		} else {
			$this->con->send(false);

			$status=false;
		}

		$msg = array(

					"status"    => $status,

				    "consulta" => $msgConsulta,

				);



		return $msg;
		
	}
	public function mostrarUsuarios($id){
		$query="SELECT p.*, u.ID_USUARIO,u.ESTADO,u.EMAIL
				FROM PERSONAS AS p, USUARIOS AS u
				WHERE p.ID_PERSONA=u.ID_PERSONA AND u.ID_USUARIO = $id";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function notificacion(){
		$query="SELECT * FROM USUARIOS WHERE ID_TIPO=2 AND ESTADO=1;";

		$rs = $this->con->consultar($query);

		return $rs;
	}

	public function editUser($persona){
		$status = true;

		$this->con->autocommit(false);

		$msg = array();



		$consulta = array();

		$msgConsulta = array();

		$query="UPDATE PERSONAS SET NOMBRE='$this->nombre', APELLIDO_PATERNO='$this->apellidoPat', APELLIDO_MATERNO='$this->apellidoMat', CURP='$this->curp', GENERO=$this->genero, EDAD=$this->edad,FECHA_NACIMIENTO='$this->fechaNac', CELULAR='$this->cel' WHERE ID_PERSONA=$persona;";

		$this->con->insertar($query);

		$status = $this->con->check();

		array_push($consulta, $status);

		if ($consulta[0]) {

			array_push($msgConsulta, "BIEN");

		} else {

			array_push($msgConsulta, $query);

		}

		$query1="UPDATE USUARIOS SET ID_TIPO=$this->tipo, EMAIL='$this->correo' WHERE ID_PERSONA=$persona;";

		$this->con->insertar($query1);

		$status = $this->con->check();

		array_push($consulta, $status);

		if ($consulta[1]) {

			array_push($msgConsulta, "BIEN");

		} else {

			array_push($msgConsulta, $query1);

		}

		if ($consulta[0]) {
			if ($consulta[1]) {
				$this->con->send(true);

				$status=true;
			} else {
				$this->con->send(false);

				$status=false;
			}
		} else {
			$this->con->send(false);

			$status=false;
		}

		$msg = array(

					"status"    => $status,

				    "consulta" => $msgConsulta,

				);



		return $msg;
	}

}
 ?>