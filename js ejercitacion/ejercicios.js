
//1Funsion que reciba un texto y devuelva una cantidad de caracteres

const texto = "Chocolatada";
console.log(texto.indexOf("latad"));    //5


//2crea una funcionn que devuelva el texto en mayusculas

const textoso = "arroz con lentejas";
console.log(textoso.toUpperCase()); 

//3funcion que reciba texto y devuelva una palabra

const textos = "presidencia de la nacion";
console.log(textos.isArray("de"));


//4crear una funcion que devuelva el texto sin espacios al inicio ni al final

const text = "      Jamon       ";
console.log(text.trim()); //Jamon


// 5crear una funcion que reciba una frase y devuelva un array con cada palabra por separado

const texty = "Manzana,archivo,agua";
console.log(texty.split(",")); //(3)['Manzana', 'archivo', 'agua']


//6crear una funcion que reciba un texto y una letra, y devuelva (trueo o false) si el texto empieza con esa letra

const textou = "Pera"; //false
console.log(textou.startsWith('Pera'));

//7Agregar elemento: crear una funcion que reciba un array y un elemento, y agregue ese elemento al final del array.
const elemento = ["llave"];
console.log(elemento.length); // 2
elemento.push("puerta");
console.log(elemento); // ["llave", "puerta"]


//8Primer elemento: crear una funcion que reciba un array y devuelva su primer elemento.
const elementos = [10, 20, 30];
console.log(elementos.indexOf(20)); // 1

//9Sumar dos números: crear una función que reciba dos números y devuelva la suma de ambos.

let numero1 = 10;
let numero2 = 5;

const suma = numero1 + numero2;
console.log(suma);

//10Duplicar numeros: crear una funcion que reciba un array de numeros y devuelva un nuevo array con cada numero multiplicado por 2.


const numero = [2, 4, 6, 8, 9];

console.log(duplicar(numero));
function duplicar(numero) {
    numero.forEach(n => {
     console.log(n*2)  
    });
}

//11 Mayores a 10: crear una función que reciba un array de números y devuelva solo los que sean mayores a 10.

const numeros = [13, 5, 67, 3];
console.log(mayor(numeros));
function mayor(numeros) {
    numeros.forEach(M => {
        console.log(M > 10)
    });
}

// 12Buscar número: crear una función que reciba un array y un número, y devuelva TRUE si el número está dentro del array.
const number =  [13, 8, 4, 0];
console.log(buscar(number));
function buscar(number){
    number.forEach(V => {
        console.log(V = 13)
    });
}
//13Imprimir elementos: crear una función que reciba un array y muestre por consola cada uno de sus elementos.
const element = [11, 7, 32, 9, 5];
console.log(imprimir(element));
function imprimir(element){
    element.forEach(E => {
        console.log(E = E)
    });
}
//14Unir en texto: crear una función que reciba un array y devuelva todos sus elementos unidos en un solo texto, separados por ” - “.
const mesa = ["agus", "beli", "celu"];
console.log(mesa.join("-")); // "agus, beli, celu"
//15Ordenar números: crear una función que reciba un array de números y lo devuelva ordenado de menor a mayor.
const menor = [66, 9, 68, 2];
menor.sort((a, b) => a - b);
console.log(menor); // [2, 9, 66, 68]