const cuadrado = (numero) => {
    return numero * numero;
}
const input = prompt("Ingrese un numero para calcular su cuadrado:");
const resultado = cuadrado(parseInt(input));
alert("El cuadrado de "+ input +" es: "+resultado);

const numero = document.getElementById("n1");
const muestra1 = document.getElementById("muestra1");

//ejercicio n2

function convertirMayusculas() {
    const palabra = document.getElementById("palabra").value;
    const resultado = palabra.toUpperCase();
    document.getElementById("resultado").textContent = resultado;
  }
  
//ejercicio n3

const numerosPares = [43, 2, 10, 35, 29, 30];
  function mostrarPares() {
    const pares = numerosPares.filter(numero => numero % 2 === 0);
      document.getElementById("resultado3").innerHTML =
        pares.join(", ");
  }

//ejercicio n4

function buscarPalabra() {
      const texto = document.getElementById("textoBusqueda").value;
      const palabra = document.getElementById("palabraBusqueda").value;
      const resultado = document.getElementById("resultado4");
        if (texto.toLowerCase().includes(palabra.toLowerCase())) {
           resultado.innerHTML = "La palabra se encuentra en el texto.";
          resultado.classList.remove("no-encontrado");
          resultado.classList.add("encontrado");
        } else {
    resultado.innerHTML = "La palabra no se encuentra en el texto.";
  resultado.classList.remove("encontrado");
  resultado.classList.add("no-encontrado");
  }
    }

//ejercicio n5

function unirNombreApellido() {
  const nombre = document.getElementById("nombre").value;
  const apellido = document.getElementById("apellido").value;
  const nombreCompleto = nombre + "" + apellido;
  const resaltado = document.getElementById("resaltado");
  
  
  resaltado.innerHTML = nombreCompleto.toUpperCase();
  resaltado.classList.toggle("resaltado");
}

//ejercicio n6

const numeros = [10, 25, 8, 17, 30];

function sumarNumeros() {
    let suma = 0;
    for (let i = 0; i < numeros.length; i++) {
        suma += numeros[i];
    }
    document.getElementById("resultado6").innerHTML =
        "La suma es: " + suma;
}

//ejercicio n7

const nombres = [
  "Lucia",
  "Carlos",
  "Ana",
  "Martin",
  "Sofia"
];

function ordenarNombres() {
  const nombresOrdenados = [nombres].sort();
  const nombresUnidos = nombresOrdenados.join(",");
  const resultado = document.getElementById("resultado7");

    resultado.innerHTML = nombresUnidos;

    if (nombresUnidos.length >= 5) {
        resultado.classList.add("resaltado_nombres");
    } else {
        resultado.classList.remove("resaltado_nombres");
    }
}