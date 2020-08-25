/*Math.random()

console.log(Math.random());

document.write(Math.random());*/
function ejer1(){
	document.write("<table>");
	let numero= prompt("Escribe un numero: ");
	for (let i = 1; i<numero; i++) {
		document.write("<tr><td>"+ i+ "</td><td>"+ i*i+"</td></tr>");
		
	}
	document.write("</table>");
}

function ejer2(){
	document.write("<table>");
	let numero= prompt("Escribe un numero: ");
	for (let i = 1; i<numero; i++) {
		document.write("<tr><td>"+ i+ "</td><td>"+ i*i+ "</td><td>"+ "</td><td>"+ i*i*i+"</td></tr>" );
		
	}
	document.write("</table>");
}


function ejer3(){
	let fecha2= new Date();
	let numero1 = Math.floor((Math.random() * 10));
	let numero2= Math.floor((Math.random() * 10));
	let result=numero1 + numero2;	



	let numero= prompt("Pon el resultado de la suma de los numeros: "+numero1+ "+"+numero2);

	if(numero== result){
		alert( "correct" );
		document.write("fecha de final<br>"+ fecha2 );

	}else{ 
		alert( "incorrect" );
		document.write("fecha de final<br>"+ fecha2 );

	}
}

function ejer4(){

	array= [1,-2,3,-2,0,0,0,5];

	document.write("<br>El arreglo es <br>");



	for(let i=0; i<8; i++){
		document.write(array[i]);
		
	}


	let ceros=0,mayores=0, menores=0;

	for(let i=0; i<8; i++){
		if (array[i]<0) {
			menores++;

		}else if (array[i]==0) {
			ceros++;

		}else if(array[i]>0){
			mayores++;


		}
	}

	document.write("<br>La cantidad de numeros menores a 1 son<br>"+menores+ " la cantidada de ceros es<br> " +ceros+  " la cantidada de mayores a uno<br> "+mayores);

	

}


function ejer5(){
	let numeros=[[1,2,3],[4,5,6],[7,8,9]];
	
	document.write("La matriz es");

	for(let i=0; i<3; i++){
		for(let j=0; j<3; j++){
			document.write(numeros[i][j]);

		}
		document.write("<br>");
	}


	for(let i=0; i<3; i++){
		let sumarenglones=0;
		for(let j=0; j<3; j++){
			sumarenglones +=numeros[i][j];


		}
		document.write("<br>La suma del renglon"+i+ "es " +sumarenglones);
	}
	document.write("<br>");

}

document.write("<br>");


function ejer7(){
	let val= prompt("Escribe un numero que desea sacarle el promedio a sus digitos: ");
	let sum = 0;
    while (val) {
    	sum += val % 10;
    	val= Math.floor(val / 10);
    }
    document.write(sum+"<br>");
}

document.write("<br>");



function ejer6(){
	let val= prompt("Escribe un numero que desea invertir: ");
	let invertido=0;
	let piso=val;
	do {
		invertido = invertido * 10 + (piso % 10);
		piso = Math.floor(piso / 10);


	}while(piso>0);
	document.write("<br>"+invertido+"<br>");

}
document.write("<br>");



ejer1();
ejer2();
var fecha= new Date();
document.write("fecha de inicio<br>"+ fecha );
ejer3();
ejer4();
ejer5();
ejer6();
ejer7();
