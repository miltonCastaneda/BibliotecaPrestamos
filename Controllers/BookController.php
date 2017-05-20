

<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once '../Models/BookModel.php';

$Model = new BookModel();


$Accion = $_POST['Accion'];



	switch($Accion){

		case 'Consult':
			$Id   = $_POST['Referencia'];
			$Book = $Model->getBookByRefer($Id);

			if(count($Book) == 0){
				echo "NoExiste";
			}else{
				echo json_encode($Book);
			}
			break;
		case 'SaveBook':
		
			$Refer       =  $_POST['Referencia'];
			$Titulo      =  $_POST['Titulo'];
			$Autor       =  $_POST['Autor'];
			$Categoria   =  $_POST['Categoria'];
			

			$res = $Model->saveBook($Refer,$Titulo,$Autor,$Categoria);

			if($res != false){
				echo 'OK';
			}else{
				echo "Fallo";
			}
			
			break;
		case 'UpdateBook':

			$Refer       =  $_POST['Referencia'];
			$Titulo      =  $_POST['Titulo'];
			$Autor       =  $_POST['Autor'];
			$Categoria   =  $_POST['Categoria'];

			$Model->updateBook($Refer,$Titulo,$Autor,$Categoria);

			echo "OK";
		case 'Delete':
			$Refer       = $_POST['Referencia'];
			$resp = $Model->deleteBookByRefer($Refer);

			if($resp == "OK"){
				echo "OK";
			}else{
				echo "Fallo";
			}
		default:
			break;
	}