<?php 

  require_once("php/model.php");


  session_start();

  include("_header.html");
  include("../Navbar/_navbar.html");
  include("_container.html");
  include("_modal_registrar.html");
  include("_modal_editar.html");
  include("_boton_registrar.html");
  include("_barra_de_busqueda.html");

  include("_tabla_personal.html");

  include("_endcontainer.html");
  include("_footer.html"); 

 ?>