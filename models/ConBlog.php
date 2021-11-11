<?php

namespace Model;
use Intervention\Image\ImageManager;
class ConBlog extends ActiveRecord{
    protected static $tabla = 'contblog';
    protected static $columnasDB = ['id', 'seccion', 'TituloSeccion','video','imagen','txt','blog_id'];

    public $blog_id = '';
    public $txt = '';
    public $imagen='';
    public $video = '';
    public $TituloSeccion = '';
    public $seccion='';
    public $id;
    
    public function __construct($args = [],$i=0){
        $this->TituloSeccion= $args["seccion".$i] ?? null;
        $this->seccion=$i;
    }
    public function getID($id){
        if ($id) {
            //echo
            $this->id = $id;
        }
    }
   
    public  function setVideo($vio)
    {
       
         //Elimina la imagen previa
         if (!is_null($this->id)) {
            echo $this->id;
            echo 'xxx';
            //debuguear(!is_null($this->id));

            $this->borrarVideo();
        }
        //asignar al atributo de imagen
        if ($vio) {
            echo 'dd';
            $this->video = $vio;
        }
        
    }
    public  function setId_blog($Id_blog)
    {
         
         if (!is_null($this->id)) {
            echo $this->id;
            echo 'xxx';
            
        }
        //asignar al atributo de imagen
        if ($Id_blog) {
            //echo
            $this->blog_id =$Id_blog;
        }
        
    }
    public static function  find_blog_id($id,$colunaRel,$tablaRelacion){
        //llamar la tabla
        $query="SELECT DISTINCT ".static::$tabla.".* FROM ".$tablaRelacion;
        $query.=" INNER JOIN ".static::$tabla." ON ".static::$tabla.".".$colunaRel."='".$id."'";
       // debuguear($query);  
        $resultado = self::consultarSQL($query);
       // debuguear($resultado);
        return $resultado;
       
    }
    public function eliminar()
    {
        // Eliminar la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado) {
            $this->borrarImagen();
            $this->borrarTxt();
            $this->borrarVideo();
            header('location: /paginaDeControl?resultado=3');
        }


        //debuguear($query);
    }
    public static function getcantidad($cantidad)
    {

        $query = "SELECT * FROM " . static::$tabla . " ORDER BY blog_id DESC LIMIT " . $cantidad;
        //debuguear($query);
        $resultado = self::consultarSQL($query);
        //echo "hola";
        
        return $resultado;
    }
      
    
}