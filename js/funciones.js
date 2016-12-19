


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
function soloNumerosyKsinpuntos(e)
{
    var keynum = window.event ? window.event.keyCode : e.which;

     if ((keynum == 8) || (keynum ==45) || (keynum ==107)|| (keynum ==75)){
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




function mostrarCargando(){
    document.getElementById("divCargando").innerHTML ='<div id="over" class="adelante"><p id="textoCargando">CARGANDO</p></div><div id="fade" class="atras">&nbsp;</div>';
}
function ocultarCargando(){
    document.getElementById("divCargando").innerHTML ='';
}
