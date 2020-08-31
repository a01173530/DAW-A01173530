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

let baseDeDatos = [
    {
        id: 1,
        nombre: "Jepeta",
        precio: 50000,
        imagen: "Imagenes/Jepeta.jpg"
    },
    {
        id: 2,
        nombre: "Tsuru",
        precio: 100000,
        imagen: "Imagenes/Tsuru.jpg"
    },
    {
        id: 3,
        nombre: "Vocho",
        precio: 70000,
        imagen:"Imagenes/Vocho.jpg"
    }

]
let $items = document.querySelector("#items");
let carrito = [];
let total = 0;
let $carrito = document.querySelector("#carrito");
let $total = document.querySelector("#total");
let $botonVaciar = document.querySelector("#boton-vaciar");

function renderItems() {
    for (let info of baseDeDatos) {
        // Estructura
        let miNodo = document.createElement("div");
        miNodo.classList.add("card", "col-sm-4");
        // Body
        let miNodoCardBody = document.createElement("div");
        miNodoCardBody.classList.add("card-body");
        // Titulo
        let miNodoTitle = document.createElement("h5");
        miNodoTitle.classList.add("card-title");
        miNodoTitle.textContent = info["nombre"];
        // Imagen
        let miNodoImagen = document.createElement("img");
        miNodoImagen.classList.add("img-fluid");
        miNodoImagen.setAttribute("src", info["imagen"]);
        // Precio
        let miNodoPrecio = document.createElement("p");
        miNodoPrecio.classList.add("card-text");
        miNodoPrecio.textContent = info["precio"] + "$";
        // Boton 
        let miNodoBoton = document.createElement("button");
        miNodoBoton.classList.add("btn", 'btn-primary');
        miNodoBoton.textContent = "+";
        miNodoBoton.setAttribute("marcador", info["id"]);
        miNodoBoton.addEventListener("click", anyadirCarrito);
        // Insertamos
        miNodoCardBody.appendChild(miNodoImagen);
        miNodoCardBody.appendChild(miNodoTitle);
        miNodoCardBody.appendChild(miNodoPrecio);
        miNodoCardBody.appendChild(miNodoBoton);
        miNodo.appendChild(miNodoCardBody);
        $items.appendChild(miNodo);
    }
}
function anyadirCarrito() {
    carrito.push(this.getAttribute("marcador"))
    calcularTotal();
    renderizarCarrito();

}

function renderizarCarrito() {
    $carrito.textContent = "";
    let carritoSinDuplicados = [...new Set(carrito)];
    carritoSinDuplicados.forEach(function (item, indice) {
        let miItem = baseDeDatos.filter(function(itemBaseDatos) {
            return itemBaseDatos["id"] == item;
        });
        let numeroUnidadesItem = carrito.reduce(function (total, itemId) {
            return itemId === item ? total += 1 : total;
        }, 0);
        let miNodo = document.createElement("li");
        miNodo.classList.add("list-group-item", "text-right", "mx-2");
        miNodo.textContent = `${numeroUnidadesItem} x ${miItem[0]["nombre"]} - ${miItem[0]["precio"]}$`;
        let miBoton = document.createElement("button");
        miBoton.classList.add("btn", "btn-danger", "mx-5");
        miBoton.textContent = "X";
        miBoton.style.marginLeft = "1rem";
        miBoton.setAttribute("item", item);
        miBoton.addEventListener("click", borrarItemCarrito);
        miNodo.appendChild(miBoton);
        $carrito.appendChild(miNodo);
    })
}

function borrarItemCarrito() {
    let id = this.getAttribute("item");
    carrito = carrito.filter(function (carritoId) {
        return carritoId !== id;
    });
    renderizarCarrito();
    calcularTotal();
}

function calcularTotal() {
    total = 0;
    for (let item of carrito) {
        let miItem = baseDeDatos.filter(function(itemBaseDatos) {
            return itemBaseDatos["id"] == item;
        });
        total = total + miItem[0]["precio"];
    }
    $total.textContent = total.toFixed(2);
}

function vaciarCarrito() {
    carrito = [];
    renderizarCarrito();
    calcularTotal();
}

$botonVaciar.addEventListener("click", vaciarCarrito);
document.getElementById("boton").addEventListener("click",multiplicacion);
renderItems();


function multiplicacion(){
	var num1= document.getElementById("num1").value;
	var num2= document.getElementById("num2").value;
	var multi= parseInt(num1) * parseInt(num2);
	alert("La multiplicacion es: " +multi);

}

