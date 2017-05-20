<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once '../Models/UserModel.php';

$Model = new UserModel();


$ArrayUsuarios = $Model->getAllUsers();

/*echo '<pre>';
print_r($ArrayUsuarios);
die();*/

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Bibliotecario</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="Views/css/style.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

	<div class="bs-component">
              <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../index.php" style="margin-right: 12em;">Sistema Prestamos Bibliotecario</a>
                  </div>

                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav">
                      <li><a href="../Views/Usuarios.php">Usuarios</a></li>
                      <li><a href="../Views/Libros.php">Libros</a></li>
                      <li><a href="../Views/Prestamos.php">Prestamos</a></li>
                      <li class="dropdown active">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Informes <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Reporte Usuarios</a></li>
                          <li><a href="../Views/ListadoLibros.php">Reporte Libros</a></li>
                          <li><a href="../Views/ListaPrestamos.php">Reporte Prestamos</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
  <div class="page-header">
    <h1>Informe de Usuarios</h1>
    <h4>Puede ver la informacion y el estatus de todos sus usuarios.</h4>
  </div>
  <table id="TableUsuarios" class="table table-striped table-hover ">
    <thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Email</th>
        <th>Telefono</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <?php

           foreach ($ArrayUsuarios as $key => $value) {
             ?><tr>
               <td><?php echo $value['idUsuario']?></td>
               <td><?php echo $value['Nombre']?></td>
               <td><?php echo $value['Apellidos']?></td>
               <td><?php echo $value['Email']?></td>
               <td><?php echo $value['Telefono']?></td>
               <?if($value['Estado'] == '0'){
                  ?><td><span class="label label-primary">Disponible</span></td><?
               }elseif($value['Estado'] == '1'){
                  ?><td><span class="label label-warning">En Prestamo</span></td><?
               }else{
                  ?><td><span class="label label-danger">Deudor</span></td><?
               }?>
               </tr><?

               

           }


      ?>
    </tbody>
  </table>


   <div class="modal" id="ModalAlertas">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Mensaje</h4>
          </div>
          <div class="modal-body">
            <p id="TextoAlerta"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar Mensaje</button>
          </div>
        </div>
      </div>
</div>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="jquery-validate.js"></script>
</body>
</html>