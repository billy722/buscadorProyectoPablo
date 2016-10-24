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
            }
    }
    public function insertar($arg_consulta){
      //echo $arg_consulta;

          if ($this->con->query($arg_consulta)) {
                return true;
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
          return $listado;
        }


      return mysqli_fetch_array($resultado, MYSQLI_ASSOC);
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
            $cantidad= $resultado->num_rows;
            return $cantidad;
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

    public function BuscarFiltarRegistros($arg_tabla,$arg_campoBuscar,$arg_palabraBuscar,$arg_pagina,$arg_cantidadRegistros){
      $consulta="";
      $cantidadRegistros = $arg_cantidadRegistros;
      $inicio = ($arg_pagina > 1 ) ? ($arg_pagina * $cantidadRegistros - $cantidadRegistros) : 0;
        if(trim($arg_palabraBuscar)!='_'){
          $consulta="select sql_calc_found_rows * from ".$arg_tabla." where ".$arg_campoBuscar." like '%".$arg_palabraBuscar."%' limit ".$inicio.",".$cantidadRegistros;
        }else{
          $consulta="select sql_calc_found_rows * from ".$arg_tabla." limit ".$inicio.",".$cantidadRegistros;
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
