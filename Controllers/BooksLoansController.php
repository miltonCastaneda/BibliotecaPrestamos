<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once '../Models/BooksLoansModel.php';
require_once '../Models/BookModel.php';
require_once '../Models/UserModel.php';

$Model = new BooksLoansModel();
$ModelBook = new BookModel();
$ModelUser = new UserModel();

$Accion = $_POST['Accion'];



	switch($Accion){

		case 'Consult':
			$Id   = $_POST['Referencia'];
			$User = $Model->getLoanByUser($Id);

			echo json_encode($User);
			break;
		case 'SaveLoan':
			
			$IdUsuario   =  $_POST['Identificacion'];
			$IdLibro =  $_POST['CodigoLibro'];
			$FechaPrestamo   =  $_POST['FechaPrestamo'];
			$FechaDevolucion = $_POST['FechaDevolucion'];


			$Model->saveLoan($IdUsuario,$IdLibro,$FechaPrestamo,$FechaDevolucion);

			$ModelUser->inactiveUser($IdUsuario);
			$ModelBook->inactiveBook($IdLibro);

			echo 'OK';
			break;
		case 'ValidateUser':
			$IdUsuario = $_POST['Identificacion'];

			$result = $Model->validateUser($IdUsuario);


			echo json_encode($result);

			break;
		case 'Devolucion':
			$IdUsuario = $_POST['Identificacion'];


			$Model->updateLoan($IdUsuario);

			$ModelUser->activeUser($IdUsuario);

			$IdBook = $Model->BookIdByUserId($IdUsuario);

			$ModelBook->activeBook($IdBook);

			echo "OK";

		default:
			break;
	}