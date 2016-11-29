<?php
    include("./principal/comun.php");
    require_once('recaptcha/recaptchalib.php');
    $publickey = "6LdQPg0UAAAAAHmaujbBm7E-2SSPhLJmHmffFhqz";
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="./js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="./js/funciones.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/principal.css">
</head>

<body>

  <script type="text/javascript">
   var RecaptchaOptions = {
      theme : 'white'
   };
   </script>

		<div class="container">
      <div class="login col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
			<form name="formularioLogin" id="formularioLogin" action="">
        <div class="form-group">

              <div class="inut-group">
                  <h3 class="text-primary text-center">INGRESO</h3>
              </div>

              <div class="inut-group">
                  <input class="form-control" type="text" id="txt_rut" name="txt_rut" onkeypress="return soloNumerosyK(event);" maxlength="12" onBlur="formatearRut(this.value)" placeholder="Ingrese su rut"/>
              </div>

              <div class="inut-group">
                <input class="form-control" type="password" id="txt_contrasena" name="txt_contrasena" placeholder="Contraseña"/>
              </div>
              <div class="inut-group">
                  <div id="idDivRecaptcha">
                          <?php     echo recaptcha_get_html($publickey); ?>
                  </div>

              </div>

              <div class="input-group col-xs-12">
            					<button id="botonIngreso" type="submit" class="col-xs-12 btn btn-danger">
            						Validar
            					</button>
            	</div>

              <div class="input-group">
            					<span class="text-danger info-login"></span>
            	</div>

          </div>

		  	</form>
    	</div>
		</div>

		<script type="text/javascript">
				  // document.onkeypress=function(e){
					// var esIE=(document.all);
					// var esNS=(document.layers);
					// tecla=(esIE) ? event.keyCode : e.which;
					// if(tecla==13){
					// 	 $("#formularioLogin").submit();
					//   }
					// }


 $("#formularioLogin").submit(function(event){
   event.preventDefault();

         var usuario= document.getElementById("txt_rut").value;

          if(validaRut(usuario)){//valida el rut por javascript

                   usuario=usuario.replace(/\./gi,"");
                   var contrasena= document.getElementById("txt_contrasena").value;


                  $('#botonIngreso').removeClass("btn-danger");
             			$('#botonIngreso').addClass("btn-warning");
             			$('#botonIngreso').html('<span class="giro glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Validando...');

                   $.ajax({
                     url:"./principal/verificarDatosIngreso.php?u="+usuario+"&c="+contrasena,
                     data: $("#formularioLogin").serialize(),
                     success: function(respuesta){

                           if(respuesta==1){
                             $('#botonIngreso').addClass("btn-success");
                             $('#botonIngreso').removeClass("btn-warning");
                             $('#botonIngreso').html('<span class="glyphicon glyphicon-ok"> </span>  Redireccionando...');
                             setTimeout(function(){
                               window.location="./principal/menuPrincipal.php";
                             },3000);

                           }
                           else if(respuesta==2){
                            //  $('.tapa').css({"display":"none"});
                             $('#botonIngreso').addClass("btn-danger");
                             $('#botonIngreso').removeClass("btn-warning");
                             $('.info-login').text("Rut o contraseña incorrecta");
                             $('#botonIngreso').html('Validar');
                             setTimeout(function(){
                               $('.info-login').text("");
                             },1000);

                           }else if(respuesta==3){
                            //  $('.tapa').css({"display":"none"});
                             $('#botonIngreso').addClass("btn-danger");
                             $('#botonIngreso').removeClass("btn-warning");
                             $('.info-login').text("Rut ingresado no es valido.");
                             $('#botonIngreso').html('Validar');
                             setTimeout(function(){
                               $('.info-login').text("");
                             },4000);

                           }else if(respuesta==4){


                            //  $('.tapa').css({"display":"none"});
                             $('#botonIngreso').addClass("btn-danger");
                             $('#botonIngreso').removeClass("btn-warning");
                             $('.info-login').text("Codigo de verificacion incorrecto.");
                             $('#botonIngreso').html('Validar');
                             setTimeout(function(){
                               $('.info-login').text("");

                               location.reload();
                             },1000);
                           }
                     }
                   });
          }else{
            $('#botonIngreso').addClass("btn-danger");
            $('#botonIngreso').removeClass("btn-warning");
            $('.info-login').text("El Rut Ingresado no es valido.");
            $('#botonIngreso').html('Validar');
            setTimeout(function(){
              $('.info-login').text("");
            },4000);
          }
 });
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


          document.getElementById("txt_rut").value=sRut;

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

		</script>
		<script type="text/javascript">
			$("#login").fadeIn(1000,"swing");
		</script>
		<footer>

		</footer>
	</body>
</html>
