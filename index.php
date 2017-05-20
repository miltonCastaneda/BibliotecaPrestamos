<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Bibliotecario</title>
    <link rel="stylesheet" href="Views/css/bootstrap.min.css">
    <link rel="stylesheet" href="Views/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="Views/css/style.css">
  </head>
  <body>
	<div class="bs-component">
	      <nav class="navbar navbar-inverse">
	        <div class="container-fluid">
	          <div class="navbar-header">
	            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
	              
	            </button>
	            <a class="navbar-brand" href="index.php" style="margin-right: 12em;">Sistema Prestamos Bibliotecario</a>
	          </div>     
	        </div>
	      </nav>
	    <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div>
    </div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2" style="text-align: center;">
			  <div class="page-header">
			    <h1>Bienvenido al Sistema de Prestamos Bibliotecario</h1>
			    <h4>Que Desea realizar ?</h4>
			  </div>
		</div>
	</div>
    <div class="row">
      <div class="col-md-3 col-md-offset-2">
        <a href="Views/Usuarios.php" class="btn btn-block btn-info btn-lg">Administrar Usuarios</a>
        <a href="Views/Libros.php" class="btn btn-block btn-info btn-lg">Administrar Libros</a>
      </div>
      <div class="col-md-3 col-md-offset-2">
        <a href="Views/Prestamos.php" class="btn btn-block btn-info btn-lg">Administrar Prestamos</a>
        <a href="Views/ListadoUsuarios.php" class="btn btn-block btn-info btn-lg">Informes</a>
      </div>
    </div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 
</body>
</html>