<?php

namespace Model;
use Intervention\Image\ImageManager;

class Blogs extends ActiveRecord{
    protected static $tabla = 'blogs';
    protected static $columnasDB = ['id', 'Titulo', 'Descripcion','Secciones','imagen','txt','user_id'];
    public $Descripcion='';
    public $Titulo = '';
    public $imagen;
    public $txt = '';
    public $Secciones = '';
    public $fecha='';
    public $id;
    public $user_id;
    

    public function __construct($args = []){
        $this->Titulo = $args["Titulo"] ?? null;
        $this->Descripcion=$args["Descripcion"] ?? null;
       // $this->imagen=$args["imagen-titulo"] ??'';
        $this->Secciones = $args["Secciones"] ?? '';
       // $this->txt= $args["contenido"] ?? '';
        $this->fecha=date('y/m/d');  
       // $this->id='';
    }
    public function getAutor($autor){
        $this->user_id=$autor;
    }

    
        
}