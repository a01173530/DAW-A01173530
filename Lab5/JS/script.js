function fun1(){
	let a= document.getElementById("password").value;
	let b= document.getElementById("passwords").value;

	if(a==""){
		document.getElementById("message").innerHTML="Escriba la contraseña";
		return false;
	}
	if(a.length <6){
		document.getElementById("message").innerHTML="La contraseña debe ser mayor a 6 digitos";
		return false;

	}

	if(a.length >20){
		document.getElementById("message").innerHTML="La contraseña debe ser menor a 20 digitos";
		return false;

	}
	if(a != b){
		document.getElementById("message").innerHTML="La contraseña es incorrecta";
		return false;

	}
	if(a==b){
		alert( "bienvenido" );
	}
}