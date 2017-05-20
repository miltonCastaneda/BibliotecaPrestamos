<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

class ConexionPDO{

	public $conection;


	public function __construct(){
		
		try{

			$this->conection = new PDO('mysql:host=localhost;dbname=BibliotecaPrestamos','root','root');
            $this->conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
		}catch(PDOException $e){
			die("Error al intentar conectar la base de datos.");
		}
	}
}
