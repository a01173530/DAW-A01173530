<?php  
require_once('model.php');

insertar_personal($_POST['nombre'], $_POST['telefono'], $_POST['correo'], $_POST['fechaicolab'], $_POST['fechafcolab']);

echo tabla_personal();

?>