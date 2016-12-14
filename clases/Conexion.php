<?php
class Conexion{
    private $host; //ip de la base de datos
    private $user; //tipo usuario ejemplo:root
    private $pass; // contraseña base de datos
    private $database;   //nombre de base de datos
    protected $con;  //clase conexion

    public function __construct(){
        $this->host='localhost';
       $this->user='root';
        $this->pass='';
        $this->database='pdisospechosos';

        $this->con= new mysqli($this->host,$this->user,$this->pass,$this->database);

            if($this->con->connect_errno){
                echo 'Error en la conexion'.$this->con->connect_error; // te muestra el error
                exit;
            }else{
                  //echo 'La conexion es exitosa';
                  mysqli_set_charset($this->con,"utf8");
            }
    }
    public function insertar($arg_consulta){
      //echo $arg_consulta;

          if ($this->con->query($arg_consulta)) {
                return true;
          }else if($this->con->errno=="1062"){
                echo "1062";
          }else{
              echo "Lo sentimos, este sitio web está experimentando problemas.";
              echo "Error: La ejecución de la consulta falló debido a: \n";
              echo "Query: " . $arg_consulta . "\n";
              echo "Errno: " . $this->con->errno . "\n";
              echo "Error: " . $this->con->error . "\n";
              exit;
          }

    }

  public function ejecutarProcedimiento($arg_consulta){
      //echo $arg_consulta;
       $resultado= $this->con->query($arg_consulta);
       $filas= $resultado->fetch_array();
        echo $filas['res'];
    }

    public function registros($arg_consulta){

      $result = $this->con->query($arg_consulta);
        if(!$result){
          echo 'Error '. $this->con->error;
          exit;
        }else{
          $listado = $result->FETCH_ALL(MYSQLI_ASSOC);
          $result->free_result();
          return $listado;
        }


      //return mysqli_fetch_array($resultado, MYSQLI_ASSOC);
    }

    public function cantidadRegistros($arg_consulta){
      $resultado= $this->con->query($arg_consulta);

        if (!$resultado) {
            echo "Lo sentimos, este sitio web está experimentando problemas.";
            echo "Error: La ejecución de la consulta falló debido a: \n";
            echo "Query: " . $arg_consulta . "\n";
            echo "Errno: " . $this->con->errno . "\n";
            echo "Error: " . $this->con->error . "\n";
            exit;
        }else{
          if($resultado->num_rows>0){
              return $resultado->num_rows;
          }else{
            return 0;
          }
        }
    }


    public function consultaExistencia($arg_consulta){
      //echo $arg_consulta;
      $resultado= $this->con->query($arg_consulta);

        if (!$resultado) {
            echo "Lo sentimos, este sitio web está experimentando problemas.";
            echo "Error: La ejecución de la consulta falló debido a: \n";
            echo "Query: " . $arg_consulta . "\n";
            echo "Errno: " . $this->con->errno . "\n";
            echo "Error: " . $this->con->error . "\n";
            exit;
        }else{
            if($resultado->num_rows==0) {
              return false;//entrega false si no hay registros
            }else{
              return true;//entrega true si hay registros
            }
        }
    }

    public function limpiarTexto($arg_campoTexto){
        $resultado= filter_var($arg_campoTexto, FILTER_SANITIZE_STRING);
        return $resultado;
    }
    public function limpiarNumeroEntero($arg_numero){
      $resultado= filter_var($arg_numero, FILTER_SANITIZE_NUMBER_INT);
      return $resultado;
    }
    public function limpiarCorreo($arg_correo){
      $resultado= filter_var($arg_correo,FILTER_SANITIZE_EMAIL);
      return $resultado;
    }

    public function procesaWhereBuscador($arg_campoBuscar,$arg_palabraBuscar,$arg_condicionesExtra){

      /*
        NOTAS:
            -RECIBE UNO O MAS CAMPOS DONDE BUSCAR SEPARADOS CON UN ESPACIO
            -RECIBE UN TEXTO Y LO SEPARA POR PALABRA PARA HACER LA BUSQUEDA MAS EFECTIVA
            -RECIBE CONDICIONES ADICIONALES EJM: "id_estado==1 or id_estado==3"

            -DEVUELVE UN STRING CON LAS CLAUSULAS WHERE QUE HARAN LA BUSQUEDA MAS EFECTIVA
      */
      $whereBuscar="";

              $palabrasBuscar= explode(" ",$arg_palabraBuscar);//divide palabras que desea buscar
              $camposDondeBuscar= explode(" ",$arg_campoBuscar);//divide campos en los que desea buscar

              //echo "cantidad campos: ".sizeof($camposDondeBuscar);
              $operadorUnion= (sizeof($camposDondeBuscar)>1) ? (" or ") : " and ";

              foreach($camposDondeBuscar as $cActual){//recorre campos a buscar

                      foreach($palabrasBuscar as $pActual){//recorre cada palabra a buscar
                          if(!$whereBuscar==""){
                              $whereBuscar.=$operadorUnion;
                          }
                          $whereBuscar.=" ".$cActual." like '%".$pActual."%' ";
                      }
              }

          if($arg_condicionesExtra==""){//no agrega condciones extra
                return $whereBuscar=" (".$whereBuscar.") ";
          }else{
                $whereBuscar=" (".$whereBuscar.") and (".$arg_condicionesExtra.") ";
                return $whereBuscar;
          }





    }
    public function BuscarFiltarRegistros($arg_tabla,$arg_campoBuscar,$arg_palabraBuscar,$arg_pagina,$arg_cantidadRegistros,$arg_condicionesExtra){
      /*
        NOTAS:
            -DEVUELVE LISTADO DE REGISTROS RESULTANTES DE LA BUSQUEDA EN LA FILA 0 DE UN ARRAY
            -DEVUELVE UN PAGINADOR EN LA FILA 1 DE UN ARRAY
      */

      $arg_palabraBuscar=$this->limpiarTexto($arg_palabraBuscar);

      $consulta="";
      $consultaCantidad;

      $cantidadRegistros = $arg_cantidadRegistros;
      $inicio = ($arg_pagina > 1 ) ? ($arg_pagina * $cantidadRegistros - $cantidadRegistros) : 0;

        // if($arg_palabraBuscar!=''){

          $consulta="select sql_calc_found_rows * from ".$arg_tabla."
          where ".$this->procesaWhereBuscador($arg_campoBuscar,$arg_palabraBuscar,$arg_condicionesExtra)."
           limit ".$inicio.",".$cantidadRegistros;


          $consultaCantidad="select * from ".$arg_tabla."
          where ".$this->procesaWhereBuscador($arg_campoBuscar,$arg_palabraBuscar,$arg_condicionesExtra)." ";

        // }else{
        //   $consulta="select sql_calc_found_rows * from ".$arg_tabla." limit ".$inicio.",".$cantidadRegistros;
        //   $consultaCantidad="select * from ".$arg_tabla;
        // }

        $resultado=$this->registros($consulta);
        $cantidad= $this->cantidadRegistros($consultaCantidad);

            $cantidad= ($cantidad/$arg_cantidadRegistros);
            $cantidad= ceil($cantidad);


            $paginador="";
            if($arg_pagina>1){
                  $paginador.='<a href="javascript:cambiarPagina('.($arg_pagina-1).')" class="btn btn-default back">&lArr;</a>';
            }


                for($c=1; $c<=$cantidad; $c++){
                     $paginador.='<a class="link__paginador ';
                            if($c==$arg_pagina){
                                $paginador.=" active";
                            }
                     $paginador.=' btn btn-default" href="javascript:cambiarPagina('.$c.')">'.$c.'</a>';
                }

           if($arg_pagina<$cantidad){
                 $paginador.='<a href="javascript:cambiarPagina('.($arg_pagina+1).')"class="btn btn-default forward">&rArr;</a>';
           }

        $devuelve[0][0] = $resultado;
        $devuelve[0][1] = $paginador;

        return $devuelve;
    }


/*
        public function BuscarFiltarRegistros($arg_tabla,$arg_campoBuscar,$arg_palabraBuscar,$arg_pagina,$arg_cantidadRegistros,$arg_adicionales){
      $consulta="";
      $cantidadRegistros = $arg_cantidadRegistros;
      $inicio = ($arg_pagina > 1 ) ? ($arg_pagina * $cantidadRegistros - $cantidadRegistros) : 0;
        if(trim($arg_palabraBuscar)!='_'){
           if($arg_adicionales==""){
             $consulta="select sql_calc_found_rows * from ".$arg_tabla." where ".$arg_campoBuscar." like '%".$arg_palabraBuscar."%' limit ".$inicio.",".$cantidadRegistros;
           }else{
             $consulta="select sql_calc_found_rows * from ".$arg_tabla." where ".$arg_campoBuscar." and ".$arg_adicionales." like '%".$arg_palabraBuscar."%' limit ".$inicio.",".$cantidadRegistros;
           }

        }else{
          if($arg_adicionales==""){
              $consulta="select sql_calc_found_rows * from ".$arg_tabla." limit ".$inicio.",".$cantidadRegistros;
          }else{
              $consulta="select sql_calc_found_rows * from ".$arg_tabla." where ".$arg_adicionales." limit ".$inicio.",".$cantidadRegistros;
          }
        }
        //echo $consulta;
        $resultado=$this->registros($consulta);
        $cantidad= $this->cantidadRegistros("select * from ".$arg_tabla);

            $cantidad= ($cantidad/$arg_cantidadRegistros);
            $cantidad= ceil($cantidad);

            $paginador="";
                for($c=1; $c<=$cantidad; $c++){
                   $paginador.='<a class="btn btn-default" href="javascript:cambiarPagina('.$c.')">'.$c.'</a>';
                }
        $devuelve[0][0] = $resultado;
        $devuelve[0][1] = $paginador;

        return $devuelve;
    }
*/
}
?>
