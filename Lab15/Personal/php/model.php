<?php


function conectar() {
    $conexion_bd = mysqli_connect("localhost","root","","gigis_db");
    
    if ($conexion_bd == NULL) {
        die("No se pudo conectar a la base de datos");
    }
    
    $conexion_bd->set_charset("utf8");
    
    return $conexion_bd;
}

function desconectar($conexion_bd) {
    mysqli_close($conexion_bd);
}

//para las opciones 
function select($name, $tabla, $id="id", $nombre="nombre") {
    $resultado = '<select id="'.$name.'"  name="'.$name.'" class="browser-default">';
    $resultado .= '<option value="" disabled selected>Selecciona un '.$tabla.'</option>';
    $conexion_bd = conectar();
    
    $consulta = 'SELECT '.$id.', '.$nombre.' FROM '.$tabla.' ORDER BY '.$nombre.' ASC';
    $resultados_consulta = $conexion_bd->query($consulta);  
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_BOTH)) {
        
        $resultado .= '<option value="'.$row[$id].'">'.$row[$nombre].'</option>';
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</select><label>'.$tabla.'</label>';
    
    desconectar($conexion_bd);
    return $resultado;
}

function tabla_personal( $criterio= "" ) {
    
    $consulta = 'SELECT P.IdPersonal as IdPersonal, P.NombrePersonal as NombrePersonal, P.TelefonoPersonal as TelefonoPersonal, P.CorreoPersonal as CorreoPersonal, DATE_FORMAT(P.FechaInicioLaboral,"%d/%m/%Y") as FechaInicioLaboral, DATE_FORMAT(P.FechaFinLaboral,"%d/%m/%Y") as FechaFinLaboral, P.ContratoPersonal as ContratoPersonal, P.INEPersonal as INEPersonal, P.DomicilioPersonal as DomicilioPersonal';
    $consulta .= ' FROM Personal P ';
 //   $consulta .= 'WHERE  t.Id = acusa.acusador_id AND s.Id = acusa.acusado_id';
    if($criterio != ""){
        $consulta .= 'WHERE  NombrePersonal LIKE "%'.$criterio.'%" OR TelefonoPersonal lIKE "%'.$criterio.'%" OR CorreoPersonal lIKE "%'.$criterio.'%" ';

    }
    $consulta .= ' ORDER BY P.FechaInicioLaboral DESC';
    
    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta);  
 //   var_dump($consulta);
    $resultado = '<table id="personal" class="table table-hover table-condensed table-bordered">';
    $resultado .= '<thead class="bg-warning"><tr><th>Nombre completo</th><th>Teléfono</th><th>Correo electrónico</th><th>Fecha de inicio de colaboración</th><th>Fecha de fin de colaboración</th><th>Contrato</th><th>INE</th><th>Comprobante de domicilio</th><th>Editar</th><th>Eliminar</th><tr></thead>';
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC)) { 
        //$resultado .= '<td>'.$row["IdPersonal"].'</td>';
        $resultado .= '<td>'.$row["NombrePersonal"].'</td>';
        $resultado .= '<td>'.$row["TelefonoPersonal"].'</td>';
        $resultado .= '<td>'.$row["CorreoPersonal"].'</td>';
        $resultado .= '<td>'.$row["FechaInicioLaboral"].'</td>';
        $resultado .= '<td>'.$row["FechaFinLaboral"].'</td>';
        $resultado .= '<td>'.$row["ContratoPersonal"].'</td>';
        $resultado .= '<td>'.$row["INEPersonal"].'</td>';
        $resultado .= '<td>'.$row["DomicilioPersonal"].'</td>';
       // $resultado .= '<td>'.$row["RespaldoPersonal"].'</td>';
        $resultado .= '<td>'. '<button class="btn btn-success" data-toggle="modal" data-target="#modalEdicion"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg></button>'.'</td>';
        $resultado .= '<td>'. '<button class="btn btn-danger glyphicon glyphicon-remove"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
                    </button>'.'</td>';

        $resultado .= '</tr>';
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</table>';
    
    desconectar($conexion_bd);
    return $resultado;
}

function buscar_acusaciones($acusador_id) {
    
    $consulta = 'SELECT a.acusado_id, t.nombre, a.created_at ';
    $consulta .= 'FROM acusa a, tripulante t ';
    $consulta .= 'WHERE a.acusado_id = t.Id AND acusador_id = '.$acusador_id;
    $consulta .= ' ORDER BY created_at DESC';
    
    $conexion_bd = conectar();
    $resultados_consulta = $conexion_bd->query($consulta);  
    
    $resultado = '<table id="acusaciones" class="striped">';
    $resultado .= '<tr><th>Acusados</th><th>Fecha</th><tr>';
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC)) { 
        
        $resultado .= '<tr>';
  //      $resultado .= '<td>'.$row["IdPersonal"].'</td>';
        $resultado .= '<td>'.$row["NombrePersonal"].'</td>';
        $resultado .= '<td>'.$row["TelefonoPersonal"].'</td>';
        $resultado .= '<td>'.$row["CorreoPersonal"].'</td>';
        $resultado .= '<td>'.$row["FechaInicioLaboral"].'</td>';
        $resultado .= '<td>'.$row["FechaFinLaboral"].'</td>';
        $resultado .= '<td>'.$row["ContratoPersonal"].'</td>';
        $resultado .= '<td>'. '<button class="btn btn-success" data-toggle="modal" data-target="#modalEdicion"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg></button>'.'</td>';
        $resultado .= '<td>'. '<button class="btn btn-danger glyphicon glyphicon-remove"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
                    </button>'.'</td>';

        $resultado .= '</tr>';
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    $resultado .= '</table>';
    
    desconectar($conexion_bd);
    return $resultado;
}



function insertar_personal($nombre, $telefono, $correo,  $fechai,  $fechaf) {
     
    $conexion_bd = conectar();
    // INSERT INTO `personal` (`IdPersonal`, `NombrePersonal`, `TelefonoPersonal`, `CorreoPersonal`, `Privilegio`, `FechaInicioLaboral`, `Contrato`, `Respaldo`) VALUES (NULL, 'Sebas', '9678523', 'seba@hotmail.com', '3', '12/10/20', NULL, NULL); `FechaInicioLaboral`, `FechaFinLaboral` , ?, ?  , $_POST['fechaicolab'], $_POST['fechafcolab']$fechaicolab, $fechafcolab
    $consulta = "INSERT INTO `personal` (`NombrePersonal`, `TelefonoPersonal`, `CorreoPersonal`,`FechaInicioLaboral`, `FechaFinLaboral`) VALUES (?, ? , ?, ?, ?)";
    
    if(!($statement = $conexion_bd->prepare($consulta))) {
        die("Error(".$conexion_bd->errno."): ".$conexion_bd->error);
    }
    
    if(!($statement->bind_param("sssss",$nombre, $telefono, $correo,  $fechai,  $fechaf))) {
        die("Error de vinculación(".$statement->errno."): ".$statement->error);
    }
    
    if(!$statement->execute()) {
        die("Error en ejecución de la consulta(".$statement->errno."): ".$statement->error);
    }
    
    desconectar($conexion_bd);
}

//insertar_personal('Pikachu', '9678103', 'poke@hotmail.com', '11/11/20', '12/11/21');

function eliminar_personal($id ) {
     
    $conexion_bd = conectar();
    
    $consulta = "DELETE FROM `personal` WHERE IdPersonal = ?";
    
    if(!($statement = $conexion_bd->prepare($consulta))) {
        die("Error(".$conexion_bd->errno."): ".$conexion_bd->error);
    }
    
    if(!($statement->bind_param("s",$id))) {
        die("Error de vinculación(".$statement->errno."): ".$statement->error);
    }
    
    if(!$statement->execute()) {
        die("Error en ejecución de la consulta(".$statement->errno."): ".$statement->error);
    }
    
    desconectar($conexion_bd);
}

//eliminar_personal('7');
//UPDATE `personal` SET `NombrePersonal` = 'Pol', `TelefonoPersonal` = '9678593', `CorreoPersonal` = 'pol@hotmail.com', `FechaInicioLaboral` = '2018-10-20', `FechaFinLaboral` = '2022-10-20' WHERE `personal`.`IdPersonal` = 4;


function actualizar_personal($id, $nombre, $telefono, $correo, $fechai, $fechaf ) {
     
    $conexion_bd = conectar();
    
    $consulta = "UPDATE `personal` SET `NombrePersonal` = '?', `TelefonoPersonal` = '?', `CorreoPersonal` = '?', `FechaInicioLaboral` = '?', `FechaFinLaboral`= '?' WHERE IdPersonal = ?";
    
    if(!($statement = $conexion_bd->prepare($consulta))) {
        die("Error(".$conexion_bd->errno."): ".$conexion_bd->error);
    }
    
    if(!($statement->bind_param("ssssss",$id,$nombre, $telefono, $correo, $fechai, $fechaf))) {
        die("Error de vinculación(".$statement->errno."): ".$statement->error);
    }
    
    if(!$statement->execute()) {
        die("Error en ejecución de la consulta(".$statement->errno."): ".$statement->error);
    }
    
    desconectar($conexion_bd);
}


function verificar_traidor($acusado_id) {
    $resultado = "No es un traidor.";
    $conexion_bd = conectar();
    
    $consulta = "SELECT nombre
                 FROM tripulante
                 WHERE traidor = 1 AND id = ".$acusado_id;
    
    $resultados_consulta = $conexion_bd->query($consulta); 
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC)) {
        
        $resultado = "Descubriste al traidor de ".$row["nombre"]; 
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    desconectar($conexion_bd);
    return $resultado;
}

function set_impostor($id) {
    $conexion_bd = conectar();
    
    $consulta_todos_inocentes = "UPDATE tripulante SET traidor=0";
    
    $conexion_bd->query($consulta_todos_inocentes); 
    
    $consulta_nuevo_impostor = "UPDATE tripulante SET traidor=1 WHERE id=?";
    
    if(!($statement = $conexion_bd->prepare($consulta_nuevo_impostor))) {
        die("Error(".$conexion_bd->errno."): ".$conexion_bd->error);
    }
    
    if(!($statement->bind_param("s",$id))) {
        die("Error de vinculación(".$statement->errno."): ".$statement->error);
    }
    
    if(!$statement->execute()) {
        die("Error en ejecución de la consulta(".$statement->errno."): ".$statement->error);
    }
    
    desconectar($conexion_bd);
}

function get_nombre($id) {
    $resultado = "";
    $conexion_bd = conectar();
    
    $consulta = "SELECT nombre
                 FROM tripulante
                 WHERE id = ".$id;
    
    $resultados_consulta = $conexion_bd->query($consulta); 
    
    while ($row = mysqli_fetch_array($resultados_consulta, MYSQLI_ASSOC)) {
        
        $resultado = $row["nombre"]; 
    }
    
    mysqli_free_result($resultados_consulta); //Liberar la memoria
    
    desconectar($conexion_bd);
    return $resultado;
}

function set_tripulante($id, $nombre) {
    $conexion_bd = conectar();
    
    $consulta = "UPDATE tripulante SET nombre=? WHERE id=?";
    
    if(!($statement = $conexion_bd->prepare($consulta))) {
        die("Error(".$conexion_bd->errno."): ".$conexion_bd->error);
    }
    
    if(!($statement->bind_param("ss",$nombre, $id))) {
        die("Error de vinculación(".$statement->errno."): ".$statement->error);
    }
    
    if(!$statement->execute()) {
        die("Error en ejecución de la consulta(".$statement->errno."): ".$statement->error);
    }
    
    desconectar($conexion_bd);
    
    $_SESSION["info"] = "Se actualizó el tripulante $id";
}

//acusa(5,6);
//echo tabla_personal();
?>