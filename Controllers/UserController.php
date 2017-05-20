<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once '../Models/UserModel.php';

$Model = new UserModel();


$Accion = $_POST['Accion'];

	switch($Accion){

		case 'Consult':
			$Id   = $_POST['Identificacion'];
			$User = $Model->getUserById($Id);

			if(count($User) == 0){
				echo "NoExiste";
			}else{
				echo json_encode($User);
			}

			break;
		case 'SaveUser':
			
			$Id       =  $_POST['Identificacion'];
			$Nombre   =  $_POST['Nombre'];
			$Apellido =  $_POST['Apellido'];
			$Email    =  $_POST['Email'];
			$Telefono =  $_POST['Telefono'];

			$Model->saveUser($Id,$Nombre,$Apellido,$Email,$Telefono);

			echo 'OK';
			break;
		case 'UpdateUser':
			$Id       =  $_POST['Identificacion'];
			$Nombre   =  $_POST['Nombre'];
			$Apellido =  $_POST['Apellido'];
			$Email    =  $_POST['Email'];
			$Telefono =  $_POST['Telefono'];
			
			$res = $Model->updateUser($Id,$Nombre,$Apellido,$Email,$Telefono);
			echo $res;
		case 'Delete':
			$Id       = $_POST['Identificacion'];
			$resp = $Model->deleteUserById($Id);

			if($resp == "OK"){
				echo "OK";
			}else{
				echo "Fallo";
			}
		default:
			break;
	}



  