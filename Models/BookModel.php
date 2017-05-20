<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once '../ConexionPDO.php';

class BookModel {

    public $PDO = null;
	

	private $Conexion;

	public function __construct(){
		$PDO = new ConexionPDO();
		$this->Conexion = $PDO->conection;

	}

	
	public function getBookByRefer($Refer){

		try{
			$Sql = "SELECT * 
				FROM Libros 
				WHERE Referencia = '{$Refer}' ";

			//$Consulta = $this->Conexion->prepare($Sql);
			//$Consulta->bindParam(1,$Refer);

			$res = $this->Conexion->query($Sql);

			//$Consulta->execute();

			return $res->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			echo $e->getMessage();
		}		
	}

	public function saveBook($Refer,$Titulo,$Autor,$Categ){
		
		try{
			$Sql = "INSERT INTO Libros (Referencia,Titulo,Autor,Categoria) VALUES ('{$Refer}','{$Titulo}','{$Autor}','{$Categ}');";
			$this->Conexion->query($Sql);
			return 'OK';
		}catch(Exception $e){
			echo $e->getMessage();
			return false;
		}
	}

	public function inactiveBook($Id){
		
		try{
			$Sql = "UPDATE Libros SET Estado = '1' WHERE IdLibro = '{$Id}';";
			$this->Conexion->query($Sql);
			return 'OK';
		}catch(Exception $e){
			echo $e->getMessage();
			return false;
		}
	}

	public function activeBook($Id){
		
		try{
			$Sql = "UPDATE Libros SET Estado = '0' WHERE IdLibro = '{$Id}';";
			$this->Conexion->query($Sql);
			return 'OK';
		}catch(Exception $e){
			echo $e->getMessage();
			return false;
		}
	}

	public function deleteBookByRefer($Refer){
		try{
			$Sql = "DELETE FROM Libros WHERE Referencia = '{$Refer}' ";

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

	public function getAllBooks(){
		try{
			$Sql = "SELECT * 
				FROM Libros";

			//$Consulta = $this->Conexion->prepare($Sql);
			//$Consulta->bindParam(1,$Refer);

			$res = $this->Conexion->query($Sql);

			//$Consulta->execute();

			return $res->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function getAllBooksActives(){
		try{
			$Sql = "SELECT * 
				FROM Libros WHERE Estado = '0'";


			$res = $this->Conexion->query($Sql);

			return $res->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function updateBook($Refer,$Titulo,$Autor,$Categ){
		
		try{

			$Sql = "UPDATE Libros SET  Titulo = '{$Titulo}', Autor = '{$Autor}', Categoria = '{$Categ}' WHERE Referencia = '{$Refer}' ";
			$this->Conexion->query($Sql);
		}catch(Exception $e){

			echo $e->getMessage();
		}
	}
}