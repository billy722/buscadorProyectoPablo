
function enviarFormulario(){
	/*var comprobar=0;
	var formulario = document.getElementById("formularioBusqueda");

  var contador=0;
  for (c=0;c<formulario.elements.length;c++)
	{
		//alert(formulario.elements[c].value);
		/*if(formulario.elements[c].value!=0){
			comprobar=1;
		}
    contador++;
	}

  alert("Elementos "+contador);*/

	//if(comprobar==1){
		    $.post("./filtrarSospechosos.php",$("#formularioBusqueda").serialize(),function(respuesta){
                $('#informacionSospechoso ').removeClass('informacionSospechoso');
		             document.getElementById("resultadoBusqueda").innerHTML = respuesta;
		    });

            $('html,body').animate({
                scrollTop: $("#resultadoBusqueda").offset().top
            }, 2000);
  /*  }else{
    	alert("NO HA SELECCIONADO CARACTERISTICAS");
    } */
}


function limpiarResultados(){
	document.getElementById("formularioBusqueda").reset();
	document.getElementById("resultadoBusqueda").innerHTML = "";
}


/*EVALUAR ESTAS FUNCIONES*/
function mostrarMenu(respuesta){
    $(document).ready(function(){

              if(respuesta==false){
                document.getElementById("etiquetaMensaje").innerHTML="Los datos ingresados son incorrectos";
             }else{
                document.getElementById("login").innerHTML = respuesta;
             }

    });
}



 function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

function soloNumerosyK(e)
{
    var keynum = window.event ? window.event.keyCode : e.which;

     if ((keynum == 8) || (keynum == 46) || (keynum ==45) || (keynum ==107)|| (keynum ==75)){
            return true;
     }else{

        return /\d/.test(String.fromCharCode(keynum));
    }
}
function soloNumeros(e)
{
    var keynum = window.event ? window.event.keyCode : e.which;

     if ((keynum == 8) || (keynum == 46) || (keynum ==45)){
            return true;
     }else{

        return /\d/.test(String.fromCharCode(keynum));
    }
}
 function soloLetrasNumeros(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

//VALIDACION DE CAMPO RUT
function formatearRut(str)
{

     var temp = str.replace(/\./gi,"");//quita los puntos al rut
     temp = temp.replace(/\-/gi,"");    //quita el guion al rut
     var sRut1=temp;


                    var nPos = 0; //Guarda el rut invertido con los puntos y el guión agregado
                    var sInvertido = ""; //Guarda el resultado final del rut como debe ser
                    var sRut = "";

                     for(var i=sRut1.length-1; i>= 0; i-- )
                    {
                        sInvertido += sRut1.charAt(i);
                        if (i==sRut1.length-1){

                            sInvertido += "-";
                        }else if (nPos == 3){

                            sInvertido += ".";
                            nPos = 0;
                        }
                        nPos++;
                    }
                    for(var j = sInvertido.length - 1; j>= 0; j-- )
                    {
                        if (j != sInvertido.length ){
                            sRut += sInvertido.charAt(j);
                        }
                    }


    document.getElementById("rut").value=sRut;
    validaRut(sRut);
}


function validaRut(str)
{
    var rut = str.replace(/\./gi, "");

    //Valor acumulado para el calculo de la formula
    var nAcumula = 0;
    //Factor por el cual se debe multiplicar el valor de la posicion
    var nFactor = 2;
    //Dígito verificador
    var nDv = 0;

    //extraemos el digito verificador (La K corresponde a 10)
    if(rut.charAt(rut.length-1).toUpperCase()=='K'){
        nDvReal = 10;
    //el 0 corresponde a 11
    }else{
            if(rut.charAt(rut.length-1)==0){
                nDvReal = 11;
            }else{
                nDvReal = rut.charAt(rut.length-1);
            }
    }

           for(nPos=rut.length-2; nPos>0; nPos--){

                    var numero = rut.charAt(nPos-1).valueOf();
                    nAcumula =nAcumula+( numero*nFactor);

                    nFactor= nFactor+1;
                    if (nFactor==8){
                         nFactor = 2;
                    }

            }

   nDv = 11-(nAcumula%11);

    if (nDv == nDvReal){
            return true;
    }else{
        return false;
    }

}


function agregarCampoFoto(){
  var contadorTr=$("#tablaFotosIngreso tr").length-1;
  contadorTr++;

  //alert(contadorTr);
      $("#tablaFotosIngreso").append('<tr><td><input name="foto'+contadorTr+'" type="file"></input></td><td><input type="date" name="fechaFoto'+contadorTr+'"></td><td><input type="checkbox" name="tipoFoto'+contadorTr+'"></td></tr>');
      $("#contadorFotos").val(contadorTr);
}

function removerCampoFoto(){
     var cantidad= $("#contadorFotos").val();

     if(cantidad!=1){
         $("#tablaFotosIngreso tr:last").remove();

          cantidad--;
           $("#contadorFotos").val(cantidad);
      }
}







function mostrarCargando(){
    document.getElementById("divCargando").innerHTML ='<div id="over" class="adelante"><p id="textoCargando">CARGANDO</p></div><div id="fade" class="atras">&nbsp;</div>';
}
function ocultarCargando(){
    document.getElementById("divCargando").innerHTML ='';
}
