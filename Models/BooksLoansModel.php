<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once '../ConexionPDO.php';

class BooksLoansModel {

    public $PDO = null;
	

	private $Conexion;

	public function __construct(){
		$PDO = new ConexionPDO();
		$this->Conexion = $PDO->conection;

	}

	
	public function getLoanByUser($Id){

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

	public function updateLoan($Id){
		try{

			$IdUser = $this->userID($Id);
			$Sql = "UPDATE Prestamos SET Estado = '2' WHERE IdUsuario = '{$IdUser}' ";

			//$Consulta = $this->Conexion->prepare($Sql);
			//$Consulta->bindParam(1,$Refer);

			$this->Conexion->query($Sql);

			//$Consulta->execute();

			return "OK";
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function actualizarPrestamo($Id){
		try{

			$Sql = "UPDATE Prestamos SET Estado = '1' WHERE IdPrestamo = '{$Id}' ";

			$this->Conexion->query($Sql);

			return "OK";
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function userID($Id){
		try{

			
			$Sql = "SELECT idUsuario FROM Usuarios WHERE Identificacion = '{$Id}' ";

			//$Consulta = $this->Conexion->prepare($Sql);
			//$Consulta->bindParam(1,$Refer);

			$res = $this->Conexion->query($Sql);

			//$Consulta->execute();

			$data = $res->fetchAll(PDO::FETCH_ASSOC);
			return $data[0]['idUsuario'];
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function BookIdByUserId($Id){

		$IdUser = $this->userID($Id);

		$Sql = "SELECT IdLibro FROM Prestamos WHERE IdUsuario = '{$IdUser}' ";

			//$Consulta = $this->Conexion->prepare($Sql);
			//$Consulta->bindParam(1,$Refer);

			$res = $this->Conexion->query($Sql);

			//$Consulta->execute();

			$data = $res->fetchAll(PDO::FETCH_ASSOC);
			return $data[0]['IdLibro'];
	}

	public function getAllLoans(){
		try{
			$Sql = "SELECT P.IdPrestamo,L.Titulo,P.FechaPrestamo, P.FechaDevolucion, U.Nombre, U.Apellidos, U.Email, U.Telefono, P.Estado FROM Usuarios U INNER JOIN Prestamos P ON P.IdUsuario = U.idUsuario INNER JOIN Libros L ON L.IdLibro = P.IdLibro";

			//$Consulta = $this->Conexion->prepare($Sql);
			//$Consulta->bindParam(1,$Refer);

			$res = $this->Conexion->query($Sql);

			//$Consulta->execute();

			return $res->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function saveLoan($IdUsuario,$IdLibro,$FechaPrestamo,$FechaDevolucion){
		
		$UserId = $this->userID($IdUsuario);


		try{
			$Sql = "INSERT INTO Prestamos (IdLibro,IdUsuario,FechaPrestamo,FechaDevolucion) VALUES ('{$IdLibro}','{$UserId}','{$FechaPrestamo}','{$FechaDevolucion}');";
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

	public function validateUser($Id){

		 try{

			$Query = "SELECT COUNT(*) as Total,Nombre FROM Usuarios WHERE Identificacion = '{$Id}' ";
			$result = $this->Conexion->query($Query);
			return $result->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			echo $e->getMessage();
			return false;
		}
	}
}