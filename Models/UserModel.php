<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once '../ConexionPDO.php';

class UserModel {

    public $PDO = null;
	

	private $Conexion;

	public function __construct(){
		$PDO = new ConexionPDO();
		$this->Conexion = $PDO->conection;

	}

	
	public function getUserById($Id){

		try{
			$Sql = "SELECT * 
				FROM Usuarios 
				WHERE Identificacion = '{$Id}' ";

			//$Consulta = $this->Conexion->prepare($Sql);
			//$Consulta->bindParam(1,$Refer);

			$res = $this->Conexion->query($Sql);

			//$Consulta->execute();

			return $res->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			echo $e->getMessage();
		}		
	}

	public function inactiveUser($Id){

		try{
			$Sql = "UPDATE Usuarios SET Estado = '1' WHERE Identificacion = '{$Id}' ";

			//$Consulta = $this->Conexion->prepare($Sql);
			//$Consulta->bindParam(1,$Refer);

			$this->Conexion->query($Sql);

			//$Consulta->execute();

			return "OK";
		}catch(Exception $e){
			echo $e->getMessage();
		}		
	}

	public function activeUser($Id){

		try{
			$Sql = "UPDATE Usuarios SET Estado = '0' WHERE Identificacion = '{$Id}' ";

			//$Consulta = $this->Conexion->prepare($Sql);
			//$Consulta->bindParam(1,$Refer);

			$this->Conexion->query($Sql);

			//$Consulta->execute();

			return "OK";
		}catch(Exception $e){
			echo $e->getMessage();
		}		
	}

	public function deleteUserById($Id){
		try{
			$Sql = "DELETE FROM Usuarios WHERE Identificacion = '{$Id}' ";

			//$Consulta = $this->Conexion->prepare($Sql);
			//$Consulta->bindParam(1,$Refer);

			$res = $this->Conexion->query($Sql);

			//$Consulta->execute();

			return "OK";
		}catch(Exception $e){
			return false;
			echo $e->getMessage();
		}
	}

	public function getAllUsers(){
		try{
			$Sql = "SELECT * 
				FROM Usuarios";

			//$Consulta = $this->Conexion->prepare($Sql);
			//$Consulta->bindParam(1,$Refer);

			$res = $this->Conexion->query($Sql);

			//$Consulta->execute();

			return $res->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function saveUser($Id,$Nomb,$Apell,$Email,$Tel){
		
		try{
			$Sql = "INSERT INTO Usuarios (Identificacion,Nombre,Apellidos,Email,Telefono) VALUES ('{$Id}','{$Nomb}','{$Apell}','{$Email}','{$Tel}');";
			$this->Conexion->query($Sql);
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function updateUser($Id,$Nomb,$Apell,$Email,$Tel){

		try{

			$Query = "UPDATE Usuarios SET Nombre = '{$Nomb}', Apellidos = '{$Apell}', Email = '{$Email}', Telefono = '$Tel' WHERE Identificacion = '{$Id}' ";
			$this->Conexion->query($Query);
			return "OK";
		}catch(Exception $e){
			echo $e->getMessage();
			return false;
		}
	}
}