<<?php 

function prom( $array){
	$promedio=0;
	for($i=0; $i <count($array); $i++) {
		$promedio+=$array[$i];

	}
	$promedio= $promedio/count($array);
	return "<h3>El promedio es $promedio<h3> <br>"; 

}


function median($arr) {
	sort($arr);
	$count = count($arr);
	$mid = floor(($count-1)/2);

	if($count % 2) {
		$mediana = $arr[$mid];
	} else {

		$low = $arr[$mid];
		$high = $arr[$mid+1];
		$mediana = (($low+$high)/2);
	}
	return "<h3>El la media es $mediana<h3> <br>";
}



function tablex($numero){
	$table="<table>";

	for ($i = 1; $i<$numero; $i++) {
		$table.="<tr><td>". $i. "</td><td>". $i*$i. "</td><td>". "</td><td>". $i*$i*$i. "</td></tr>";
		
	}
	$table.="</table>";

	return $table;
}


function listamenor($array){
	$lista= "<ol>";

	sort($array);

	for($i=0; $i<count($array);  $i++){
		$lista.="<li>". $array[$i]. "</li>";

	}
	$lista.="</ol>";

	return "La lista de menor a mayor es". $lista. prom($array). median($array);

}


function listamayor($array){
	$lista= "<ol>";

	rsort($array);

	for($i=0; $i<count($array);  $i++){
		$lista.="<li>". $array[$i]. "</li>";

	}
	$lista.="</ol>";

	return "La lista de mayor a menor es ". $lista .prom($array). median($array);

}

function binaria($num){
	$num=decbin ( $num );
	return "El binario de 12 es ". $num;

}

echo prom(array(1, 2, 3, 4,5,6,7,8,9,10));
echo median(array(4,2,8,10,24,15));
echo tablex(10);
echo listamenor(array(4,2,8,10,24,15,6,43,12));
echo listamayor(array(4,2,8,10,24,15,6,43,12));
echo binaria(12);


 ?>