<?php

namespace Model;

use Twilio\Rest\Messaging\V1\DeactivationsList;

class ActiveRecord
{
    protected static $db;

    protected static $columnasDB = [];
    protected static $tabla = '';

    //errores
    //
    protected static $errores  = [];
    //debuguear($errores);
    public function guardar($i='')
    {
          //debuguear($this->id);
        if (!is_null($this->id)) {
            //actualizar
           //debuguear('con id');

            $valorId=$this->actualizar();
            return $valorId;
        } else {
           //debuguear('sin id');
            //creando un nuevo registro
            $valorId=$this->crear();
            return $valorId;
        }

    }
    public function getId($atributos)
    {
       // debuguear($atributos);
        $query="SELECT *FROM ".static::$tabla." where imagen IN('".$atributos["imagen"]."')";
       // debuguear($query);
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }



    public function crear()
    {
       
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
       
        //Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
       // debuguear($query);
        $resultado = self::$db->query($query);
       // debuguear($resultado);
        // debuguear($resultado);

        if ($resultado) {
            echo " ya se subio a la db correcto";
            echo'++++';
            $valor=(array)$this->getId($atributos);
            //debuguear($valor);
            // Redireccionar al usuario.
          //  header('Location: /paginaDeControl');
          } else {
            echo "no se puedo crear error valores no existentes";
           }
        
        if (isset($valor['id'])) {
            return $valor['id'];
        }
        //debuguear('creando');
        
    }
    
    public function eliminar()
    {
        // Eliminar la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado) {
            $this->borrarImagen();
            $this->borrarTxt();
            header('location: /paginaDeControl?resultado=3');
        }


        //debuguear($query);
    }

    public function actualizar()
    {
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = " UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1";
        $resultado = self::$db->query($query);
        //
        // debuguear($query);
        if ($resultado) {
            // Redireccionar al usuario.
            //header('Location: /paginaDeControl?resultado=2');
              $valor=(array)$this->getId($atributos);
            echo 'actualizada corectamente';
            //debuguear($valor);
        }
        if(isset($valor['id'])){
            return $valor['id'];
        }
        
    }
    public static function setDB($database)
    {
        self::$db = $database;
    }
    public function atributos()
    {
        $atributos = [];


       // debuguear(static::$columnasDB);
        foreach (static::$columnasDB as $columna) {
            
            if ($columna == 'id') continue;
            $atributos[$columna] = $this->$columna;
           // echo $this->$columna.'<br/>';

            
        }
        //debuguear($atributos);
        return $atributos;
    }


    public function sanitizarAtributos()
    {
       
        $atributos = $this->atributos();
        //debuguear('sanitisando');
        //debuguear('satini');
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        //debuguear($sanitizado);
        return $sanitizado;
    }
    //subbida de archivo
    public function setImagen($imagen)
    {
        
        //Elimina la imagen previa
        if (!is_null($this->id)) {
            $this->borrarImagen();
            //debuguear('imagen eliminado');
        }
        //asignar al atributo de imagen
        if ($imagen) {
            //echo
            $this->imagen = $imagen;
        }
    }

    public function setTxt($txt)
    {
        
        //Elimina la imagen previa
        if (!is_null($this->id)) {
           
            
             //falta para actuallizar txt
            $this->borrarTxt();
            //debuguear('texto bo');
        }
        //asignar al atributo de imagen
        if ($txt) {
            //echo
            $this->txt = $txt;
        }
    }

    public static function getErrores()
    {

        return static::$errores;
    }
    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }
    public static function all()
    {
        //$query="SELECT ".$tablaVal.".* FROM ".static::$tabla ." INNER JOIN contblog ON ". static::$tabla.".id=".$tablaVal.".blog_id";
        $query= " SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        //echo "hola";
        
        return $resultado;
    }
    //
    public static function getcantidad($cantidad)
    {

        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC LIMIT " . $cantidad;
       
        $resultado = self::consultarSQL($query);
        //echo "hola";
        
        return $resultado;
    }
    //
    public static function find($id)
    {
        
        $query = "SELECT*FROM " . static::$tabla . " WHERE id = ${id}";
        
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
    public static function consultarSQL($query)
    {
        
        $resultado = self::$db->query($query);
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        
        //liberar la memoria
        $resultado->free();
        // retornar los resultados

        return $array;
    }
    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
        //  debuguear($objeto);
    }
    //Sincroniza el objero en memoria con las cambios realizados
    public function sincronizar($args=[])
    {
       //debuguear($this);
        foreach ($args as $key => $value) {
            if ($key=='id') {
                continue;
            }
            if (property_exists($this, $key) && !is_null($value)) {

                $this->$key = $value;
            }
        }
        
    }
    //eliminar imagen
    public function borrarImagen()
    {

        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }
    
    public function borrarTxt()
    {
        $existeArchivo = file_exists(CARPETA_TEXTO.$this->txt);
       // debuguear($existeArchivo);
        if ($existeArchivo) {
            echo 'texto eliminado';
            //$fp = fopen("texto/".$this->txt, "r");
            //fclose($fp);
            //no borrar en window hay que porvar unix ☻:3 
            chmod(CARPETA_TEXTO.$this->txt,0777);
            @unlink(CARPETA_TEXTO.$this->txt);
          //  debuguear(@unlink(CARPETA_TEXTO.$this->txt));
        }
    }
    public function borrarVideo()
    {
        $existeArchivo = file_exists(CARPETA_VIDEO.$this->video);
       // debuguear($existeArchivo);
        if ($existeArchivo) {
            echo 'video** eliminado';

            unlink(CARPETA_VIDEO.$this->video);
          
        }
    }
    
    public static function mensaje(){
       $resultado=10;
         if(isset($_GET['resultado'])){
            $resultado = $_GET['resultado'];
            $resultado = filter_var($resultado, FILTER_VALIDATE_INT);
        } 
        return $resultado;
    }


}

