<?php 
include("Backend/conexion.php");
$query="select*from imagenes";
$resultado= mysqli_query($conn,$query);


 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<h1 class="text-primary">Subir de imagen</h1>
				<form action="Backend/subir.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="my-input">Selecciona una imagen</label>
						<input id="my-input"  type="file" name="imagen">
					</div>
					<div class="form-group">
						<label for="my-input">Nombre de la imagen</label>
						<input id="my-input" class="form-control" type="text" name="titulo">
					</div>
					<?php if(isset($_SESSION["mensaje"])){ ?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong><?php echo $_SESSION["mensaje"]; ?></strong> 
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php  session_unset();} ?>
					<input type="submit" value="Guardar" name="Guardar">
				</form>
			</div>
			<div class="col-lg-8">
				<h1 class="text-primary text-center">Galeria de imagenes</h1>
				<br>
				<div class="card-columns">
					<?php foreach ($resultado as $row){ ?>
					<div class="card">
						<img class="card-img-top" src="Backend/imagenes/<?php echo $row["imagen"];?>" alt="...">
						<div class="card-body">
							<h5 class="card-title">Card title that wraps to a new line</h5>
							<p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
						</div>
					<?php } ?>
					</div>
			</div>
			
		</div>

	</div>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>