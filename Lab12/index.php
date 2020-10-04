<?php 
  include('Backend/conexion.php');
  $query = "select * from imagenes";
  $resultado = mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Lab 12</title>
</head>
<body>
  <div class="container">
    <div class="row">
       <div class="col-lg-4">
         <h1 class="text-primary">Subir imagen</h1>
         <form action="Backend/subir.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
              <label for="my-input">Seleccione una foto</label>
              <input id="my-input"  type="file" name="imagen">
          </div>
          <div class="form-group">
              <label for="my-input">Nombre del luchador</label>
              <input id="my-input" class="form-control" type="text" name="titulo">
          </div>
          <?php if(isset($_SESSION['mensaje'])){ ?>
          <div class="alert alert-<?php echo $_SESSION['tipo'] ?> alert-dismissible fade show" role="alert">
         <strong><?php echo $_SESSION['mensaje']; ?></strong> 
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
     </button>
       </div>
          <?php session_unset(); } ?>
          <input type="submit" value="Guardar" class="btn btn-primary" name="Guardar">
         </form>
       </div>
       <div class="col-lg-8">
           <h1 class="text-danger text-center">Galeria de Luchadores</h1>
           <hr>
           <div class="card-columns">
               <?php foreach($resultado as $row){ ?>
         <div class="card">
      <img src="Backend/imagenes/<?php echo $row['imagen']; ?>" class="card-img-top" alt="...">
       <div class="card-body">
      <h5 class="card-title"><strong><?php echo $row['nombre']; ?></strong></h5>
    </div>
               
  </div>
  <?php }?>
       </div>
    </div>

    <p>
    	¿Por qué es importante hacer un session_unset() y luego un session_destroy()? Yo supongo porque es importante vaciar las variables de la sesión con un session_unset(), para después destruir la sesion con un session_destroy() y evitar errores con variables en la sesión utilizada.
    </p>

    <br>
    <p>
    	¿Cuál es la diferencia entre una variable de sesión y una cookie?

    	Las sesiones se mantienen por un período de tiempo determinado, en el servidor o hasta que se cierre el navegador. Mientras las cookies, siempre que sean aceptadas por el navegador, se mantienen en el cliente hasta que no sea eliminada manualmente por el mismo.

    	Referencia: https://es.slideshare.net/LuisMiquelSnchezAcosta/session-y-cookies#:~:text=%EF%81%B6%20Diferencia%20entre%20session%20y,mantienen%20en%20el%20cliente%20(navegador
    </p>
    <br>
    <p>
    	¿Qué técnicas se utilizan en sitios como facebook para que el usuario no sobreescriba sus fotos en el sistema de archivos cuando sube una foto con el mismo nombre?

    	Se hace una inserción de  auto incrementación en el id.
    </p>

    <br>
    <p>
    	¿Qué es CSRF y cómo puede prevenirse?

    	Es un método por el cual un usuario intenta hacer que tus usuarios, envíen datos que no quieren enviar. Los ataques CSRF se pueden prevenir añadiendo un token CSRF a tus formularios.

    	Referencias: https://uniwebsidad.com/libros/symfony-2-4/capitulo-12/proteccion-csrf#:~:text=CSRF%20(acr%C3%B3nimo%20de%20Cross%2Dsite,token%20CSRF%20a%20tus%20formularios.
    </p>
  </div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>