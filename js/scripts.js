function permite(elEvento, permitidos) {
// Variables que definen los caracteres permitidos
var numeros = "0123456789";
var numerosdloat = "0123456789.";
var caracteres = " abcdefghijklmnñÒopqrstuvwxyzáéíúóÁÉÍÚÓÑABCDEFGHIJKLMN—_@OPQRSTUVWXYZ:;,.*-+¡!|ºª()[]{}?¿%";
var numeros_caracteres = numeros + caracteres;
var teclas_especiales = [8, 37, 39, 46,13];
// 8 = BackSpace, 46 = Supr, 37 = flecha izquierda, 39 = flecha derecha
// Seleccionar los caracteres a partir del par·metro de la funciÛn
 switch(permitidos) {
    case 'num':
        permitidos = numerosdloat;
    break;
    case 'car':
        permitidos = caracteres;
     break;
	case 'numfloat':
        permitidos = numerosdloat;
     break;
   case 'num_car':
       permitidos = numeros_caracteres;
    break;
  }
 // Obtener la tecla pulsada
     var evento = elEvento || window.event;
     var codigoCaracter = evento.charCode || evento.keyCode;
     var caracter = String.fromCharCode(codigoCaracter);
// Comprobar si la tecla pulsada es alguna de las teclas especiales
// (teclas de borrado y flechas horizontales)
   var tecla_especial = false;
   for(var i in teclas_especiales) {
       if(codigoCaracter == teclas_especiales[i]) {
          tecla_especial = true;
                break;
         }
    }
// Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
// o si es una tecla especial formularioPrincipal.txtcantidad.value
return permitidos.indexOf(caracter) != -1 || tecla_especial;
}
