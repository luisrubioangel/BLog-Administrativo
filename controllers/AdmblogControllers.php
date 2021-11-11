<?php

namespace Controllers;

use MCV\Router;
use Model\Admin;
use Model\Blogs;
use Intervention\Image\ImageManagerStatic as Image;
use LengthException;
use Model\ActiveRecord;
use Model\ConBlog;
use PHPMailer\PHPMailer\PHPMailer;
//use Twilio\Rest\Api\V2010\Account\ValidationRequestList;

class AdmblogControllers{
    public static function blogs(Router $router)
    { 
        //$tablaRelacionada='contblog';
        $Blogs=Blogs::all();
        //debuguear($Blogs);
        $auth = Autorizacion();
      $Datos=false;
      $Dato=true;
      $inicio = false;
        $router->render('paginas/blogs', [
            'auth'=>$auth,
            'Blogs'=>$Blogs,
            'registro' => false,
            'session'=>false,
            'inicio' => $inicio,
            'Datos'=>$Datos,
            'Dato'=>$Dato,
            'js'=>false
        ]);
    }
    public static function blog(Router $router)
    { 
       

        $Blogsuge=Blogs::getcantidad(5);
        $auth = Autorizacion();
        $id=$_GET['id'];
        $Blog=Blogs::find($id);
        $ConteBlog=ConBlog::find_blog_id($id,'blog_id','blogs');
       
        $autor=Admin::getautor($Blog->user_id);

    
       
      $Datos=false;
      $Dato=true;
      $inicio = false;
    // debuguear($autor);
        $router->render('paginas/blog', [
            'autor'=>$autor,
            'Blogsuge'=>$Blogsuge,
            'auth'=>$auth,
            'ConteBlog'=>$ConteBlog,
            'Blog'=>$Blog,
            'registro' => false,
            'session'=>false,
            'inicio' => $inicio,
            'Datos'=>$Datos,
            'Dato'=>$Dato,
            'js'=>false
        ]);
    }
}