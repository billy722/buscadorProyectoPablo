<?php
require_once '../clases/Usuario.php';
$Usuario = new Usuario();

 	$usuario = $_REQUEST["u"];
 	$contrasena = $_REQUEST["c"];

  require_once('../recaptcha/recaptchalib.php');
    $privatekey = "6LdQPg0UAAAAAKdU4W8Yp6C7m0bJ2RTIw03ZovWr";
    $resp = recaptcha_check_answer($privatekey,
                                  $_SERVER["REMOTE_ADDR"],
                                  $_REQUEST["recaptcha_challenge_field"],
                                  $_REQUEST["recaptcha_response_field"]);

    if (!$resp->is_valid){
      // What happens when the CAPTCHA was entered incorrectly
          // die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
          //      "(reCAPTCHA said: " . $resp->error . ")");
        echo "4"; //EL CAPTCHA ES INCORRECTO

    }else{

        $usuario= $Usuario->limpiarTexto($usuario);
        $usuario= $Usuario->limpiarNumeroEntero($usuario);

        //$contrasena= $Usuario->limpiarTexto($contrasena);
        //$contrasena= $Usuario->limpiarNumeroEntero($contrasena);



        if(!$Usuario->validarRut($usuario)){
              echo "3"; //rut no valido
        }else{


            $posicionGuion = strpos($usuario,'-');
            $soloRunConPuntos = substr($usuario,0,$posicionGuion);
            $soloRun=str_replace(".", "", $soloRunConPuntos);


            if(is_numeric($soloRun)){

                    $Usuario->setRun($soloRun);
                    $Usuario->setClave($contrasena);

                    if($Usuario->comprobarUsuario()){
                          echo "1";
                    }else{
                          echo "2";
                    }
            }else{
              echo "2";//NO ES UN NUMERO, HAY LETRAS
            }

          }
    }

 ?>
