  <?php 

 function adivinarnumero($posible){
   $secret=4;
   $resultado="";
   if($posible== $secret){
      $resultado= "Correcto el numero es: $secret ";
    }else{
      $resultado= "No te equivocaste el numero no es: ". $posible. " sigue intentando <br>";
    }

    return $resultado;

  }

  function encontrarnumero(){
    $resultado="";
    
    if(isset($_GET["secret"])){
      $resultado= adivinarnumero($_GET["secret"]);

    }else if(isset($_POST["secret"])){
      $resultado= adivinarnumero($_POST["secret"]);

    }else {
      $resultado= "Pon un numero no seas flojo";
    }
    return $resultado;

  }

  function limpiar(){
    if(isset($_GET["secret"])){

      $_GET["secret"]= htmlspecialchars($_GET["secret"]);
    }
    if(isset($_POST["secret"])){
      $_POST["secret"]= htmlspecialchars($_POST["secret"]);
    }


  }

?>
 