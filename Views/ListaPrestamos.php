<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once '../Models/BooksLoansModel.php';

$Model = new BooksLoansModel();


$ArrayPrestamos = $Model->getAllLoans();
$Hoy = date("Y-m-d");



  

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
                      <li><a href="Usuarios.php">Usuarios</a></li>
                      <li><a href="Libros.php">Libros</a></li>
                      <li><a href="Prestamos.php">Prestamos</a></li>
                      <li class="dropdown active">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Informes <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="ListadoUsuarios.php">Reporte de Usuarios</a></li>
                          <li><a href="ListadoLibros.php">Reporte de Libros</a></li>
                          <li><a href="ListaPrestamos.php">Reporte de Prestamos</a></li>

                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
  <div class="page-header">
    <h1>Informe de Prestamos</h1>
    <h4>Puede ver la informacion y el estatus de los Prestamos Actuales.</h4>
  </div>
  <table id="TableUsuarios" class="table table-striped table-hover ">
    <thead>
      <tr>
        <th>#</th>
        <th>Titulo</th>
        <th>FechaPrestamo</th>
        <th>FechaDevolucion</th>
        <th>Nombres</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <?php

           foreach ($ArrayPrestamos as $key => $value) {
             ?><tr>
               <td><?php echo $value['IdPrestamo']?></td>
               <td><?php echo $value['Titulo']?></td>
               <td><?php echo $value['FechaPrestamo']?></td>
               <td><?php echo $value['FechaDevolucion']?></td>
               <td><?php echo $value['Nombre']?></td>
               <td><?php echo $value['Apellidos']?></td>
               <td><?php echo $value['Email']?></td>
               <?
                  $Fecha = $value['FechaDevolucion'];

               if(strtotime($Hoy) > strtotime($Fecha)){
                  $Model->actualizarPrestamo($value['IdPrestamo']);
                  ?><td><span class="label label-warning">Excedio las fechas</span></td><?
               }elseif($value['Estado'] == '0'){
                  ?><td><span class="label label-primary">Estado Normal Prestamo</span></td><?
               }elseif($value['Estado'] == '1'){
                  ?><td><span class="label label-warning">Excedio las fechas</span></td><?
               }elseif($value['Estado'] == '2'){
                  ?><td><span class="label label-info">Cerrado</span></td><?
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
</body>
</html>