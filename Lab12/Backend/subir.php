<?php  
include("conexion.php");
if(isset($_POST["Guardar"])){
	$imagen= $_FILES["imagen"]["name"];
	$nombre= $_POST["titulo"];

	if(isset($imagen) && $imagen !=""){
		$tipo= $_FILES["imagen"]["type"];
		$temp= $_FILES["imagen"]["tmp_name"];
		if(!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "png")))){
			$_SESSION["mensaje"]=  'Solo puedes poner archivos jpeg, gif, png';
			header("location:../index.php");

		}else{
			$query="INSERT INTO imagenes(imagen,nombre) values('$imagen', '$nombre')";
			$resultado=mysqli_query($conn,$query);
			if($resultado){
				move_uploaded_file($temp, "imagenes/".$imagen);
				$_SESSION["mensaje"]="se subio correctamente";

			}else{
				$_SESSION["mensaje"]="ocurrio un error en el servidor";

			}
		}





	}

}


?>