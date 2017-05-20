

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Bibliotecario</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

	<div class="bs-component">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
            
              </button>
              <a class="navbar-brand" href="../index.php" style="margin-right: 12em;">Sistema Prestamos Bibliotecario</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
              <ul class="nav navbar-nav">
                <li class="active"><a href="Usuarios.php">Usuarios</a></li>
                <li><a href="Libros.php">Libros</a></li>
                <li><a href="Prestamos.php">Prestamos</a></li>
                <li class="dropdown ">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Informes <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="ListadoUsuarios.php">Reporte Usuarios</a></li>
                    <li><a href="ListadoLibros.php">Reporte Libros</a></li>
                    <li><a href="ListaPrestamos.php">Reporte Prestamos</a></li>
                    
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div>
    </div>

  <div class="page-header">
    <h1>Usuario</h1>
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-2">
       <form id="formUsuarios" class="form-horizontal">
        <fieldset>
          <legend>Administrar: Para administrar los usuarios utilice los botones de navegación</legend>
          <div class="form-group">
            <label for="Identificacion" class="col-lg-4 control-label">Identificacion</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" id="Identificacion" placeholder="Identificacion" required>
            </div>
          </div>
          <div class="form-group">
            <label for="Nombre" class="col-lg-4 control-label">Nombre</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" id="Nombre" placeholder="Nombre" required>
            </div>
          </div>
          <div class="form-group">
            <label for="Apellido" class="col-lg-4 control-label">Apellido</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" id="Apellido" placeholder="Apellido" required>
            </div>
          </div>
          <div class="form-group">
            <label for="Email" class="col-lg-4 control-label">Email</label>
            <div class="col-lg-8">
              <input type="email" class="form-control" id="Email" placeholder="Email" required>
            </div>
          </div>
          <div class="form-group">
            <label for="Telefono" class="col-lg-4 control-label">Telefono</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" id="Telefono" placeholder="Telefono" required>
            </div>
          </div>
          

          <div class="form-group">
            <div class="col-lg-10 col-lg-offset-6">
              <button type="reset" id="Cancelar" class="btn btn-default">Cancelar</button>
              <button type="submit" id="Guardar" class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>

     <div class="col-md-2 col-offset-5" style="margin: 100px 0px 0 30px;">
      <button id="Crear" class="btn btn-default btn-large btn-block">Crear</button>
      <button id="Consultar" class="btn btn-default btn-large btn-block">Consultar</button>
      <button id="Editar" class="btn btn-default btn-large btn-block">Editar</button>
      <button id="Eliminar" class="btn btn-primary btn-large btn-block">Eliminar</button>
    </div>
  </div>

  </div>
  



            



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
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="../Js/jquery-validate.js"></script>
<script src="../Js/Usuarios.js"></script> 
</body>
</html>