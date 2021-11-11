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

class BlogControllers{
    public static function crear(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         // echo json_encode($_POST);
            if(!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES,777);
                echo 'se creo carpeta iie';
            }
            if(!is_dir(CARPETA_VIDEO)) {
                mkdir(CARPETA_VIDEO,777);
                echo 'se creo carpeta vidoe';
            }
    
            if(!is_dir(CARPETA_TEXTO)) {
                echo 'se creo carpeta twex';
                mkdir(CARPETA_TEXTO,777);
            }
            
            
            $Blog=new Blogs($_POST);
            
           
       // debuguear($_POST);
            //imagenes agregar
        if (boolval($_FILES['imagen-titulo']['tmp_name'])) {
            
            $nombreImagenPrin=md5(uniqid(rand(),true)).".jpg";
            $imagenPricipal=Image::make($_FILES['imagen-titulo']['tmp_name'])->fit(800,600);
            $imagenPricipal->save(CARPETA_IMAGENES.$nombreImagenPrin);
            $Blog->setImagen($nombreImagenPrin);            
          //  $Blog->guardar();    
        }
        if(boolval($_POST['contenido'])){
            $texto=$_POST['contenido'];
            $nombreText=md5(uniqid(rand(),true)).".txt";
            $fi=fopen(CARPETA_TEXTO.$nombreText,'a') or die('problemas al subir text');
            fwrite($fi,$texto);
            fclose($fi);
            $Blog->setTxt($nombreText);
        } 
        //debuguear($_SESSION['usuario']);
        $autor=Admin::getautorenseccion($_SESSION['usuario']);
        $Blog->getAutor($autor->user_id);       
        $id_blog=$Blog->guardar();
        //debuguear($Blog);
            
       
        // debuguear($ConteBlog);
           $secciones=$_POST["Secciones"];           
           //se creo las variables para los blogs
           for($i=1;$i<=$secciones;$i++){ 
               
            $ConteBlog=new ConBlog($_POST,$i);
            //debuguear( $ConteBlog);
            if(isset($_POST['contenido'.$i])){
                //echo $_POST['contenido'.$i];
                if(boolval($_POST['contenido'.$i])){
                $text= $_POST['contenido'.$i]; 
                $nombreText=md5(uniqid(rand(),true)).".txt";
                
                $fi=fopen(CARPETA_TEXTO.$nombreText,'a') or die('problemas al subir text');
                
                fwrite($fi,$text);
                fclose($fi);
                $ConteBlog->setTxt($nombreText);
                }
            }
            
             if (isset($_FILES['video'.$i]['tmp_name'])) {
                if (boolval($_FILES['imagen'.$i]['tmp_name'])) {     
                //debuguear($nombreImagen[$i]);
                $nombreVideo=md5(uniqid(rand(),true)).".mp4";              
                $video= $_FILES['video'.$i]['tmp_name']; 
                move_uploaded_file($video, CARPETA_VIDEO . $nombreVideo);
                $ConteBlog->setVideo($nombreVideo);
                }    
             }
              
             if(isset($_FILES['imagen'.$i]['tmp_name'])) {
               // debuguear(boolval($_FILES['imagen'.$i]['tmp_name']));
                 if(boolval($_FILES['imagen'.$i]['tmp_name'])){
                    
                    $nombreImagen=md5(uniqid(rand(),true)).".jpg";
              
                    $imagen= Image::make($_FILES['imagen'.$i]['tmp_name'])->resize(800, null);
                    
                    $imagen->save(CARPETA_IMAGENES. $nombreImagen);
                    $ConteBlog->setImagen( $nombreImagen);
                   
                 }
             }
             $ConteBlog->setId_blog($id_blog);
             $ConteBlog->guardar($id_blog);
             echo $i;            
        } 
        //debuguear('blog');
      
        

         header('Location: /paginaDeControl?resultado=3');          
        }

       
      $Datos=false;
      $Actualizar=false;
        $servi = true;
        $inicio = false;
        $auth=Autorizacion();
        //debuguear($auth);
        $router->render('internas/crear', [
            'auth'=>$auth,
            'Dato'=>true,
            'Datos'=>$Datos,
            'inicio' => $inicio,
            'registro'=>false,
            'session' =>false,
            'Actualizar'=>false,
            'Blog'=>false,

        ]);
    }
    public static function actualizar(Router $router){
      
        $id=validarORedireccionar('/paginaDeControl');
        //
        $Blog=Blogs::find($id);
        $ConteBlog=ConBlog::find_blog_id($id,'blog_id','blogs');

     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
         $aut=$_POST;
         $Blog->sincronizar($aut);
         
         
         if (boolval($_FILES['imagen-titulo']['tmp_name'])) {
            echo 'eee';
            $nombreImagenPrin=md5(uniqid(rand(),true)).".jpg";
            $imagenPricipal=Image::make($_FILES['imagen-titulo']['tmp_name'])->fit(800,600);
            $imagenPricipal->save(CARPETA_IMAGENES.$nombreImagenPrin);
            $Blog->setImagen($nombreImagenPrin);            
          //  $Blog->guardar();    
        }

       
        if(boolval($_POST['contenido'])){
            $texto=$_POST['contenido'];
            $nombreText=$Blog->txt;
            unlink(CARPETA_TEXTO.$nombreText);
            $fi=fopen(CARPETA_TEXTO.$nombreText,'a');
            fwrite($fi,$texto);
            fclose($fi);
            
        }
       $secciones=intval($_POST["Secciones"]);
       $seccionesNuevas=intval($_POST["Secciones-nuevas"]); 
       $Blog->Secciones= $secciones +$seccionesNuevas; 
      $id_blog=$Blog->guardar();      
       
        
     for($i=1;$i<=count($ConteBlog);$i++){ 
         $a=$i-1;
         $ConteBlog[$a]->getID($_POST['id'.$i]);
        
         $ConteBlog[$a]->sincronizar($aut);
        
        
         $ConteBlog[$a]->TituloSeccion=$_POST['seccion'.$i];
        /*  if($i==4){
          debuguear($ConteBlog[$a]);
        } */
         
         if(isset($_POST['contenido'.$i])){
          //debuguear($ConteBlog[$a]);
             //echo $_POST['contenido'.$i];
             $file = CARPETA_TEXTO.$ConteBlog[$a]->txt;
             if(file_exists($file)) {
                if($line = fgets(fopen($file, 'r'))){
                    echo 'texto es//***existe';
                };
               }
               echo '<br/>';

            
             if(boolval($_POST['contenido'.$i])){
                  
                  
                  $text= $_POST['contenido'.$i];  
                  $nombreText=$ConteBlog[$a]->txt;
                  unlink(CARPETA_TEXTO.$nombreText);
                  $fi=fopen(CARPETA_TEXTO.$nombreText,'a');
                  fwrite($fi,$text);
                  fclose($fi);
             
           
                  echo 'txt nuevo';
             }

            
         }
         
         
          if (isset($_FILES['video'.$i]['tmp_name'])) {
             if (boolval($_FILES['video'.$i]['tmp_name'])) {     
             //debuguear($nombreImagen[$i]);
             $nombreVideo=md5(uniqid(rand(),true)).".mp4";              
             $video= $_FILES['video'.$i]['tmp_name']; 
             move_uploaded_file($video, CARPETA_VIDEO . $nombreVideo);
             $ConteBlog[$a]->setVideo($nombreVideo);
             echo 'hola'; 
             } 
               
          }
        // debuguear($_POST['contenido'.$i]);
         
          
          if(isset($_FILES['imagen'.$i]['tmp_name'])) {
         //debuguear(boolval($_FILES['imagen'.$i]['tmp_name']));
              if(boolval($_FILES['imagen'.$i]['tmp_name'])){
                echo 'imagen exxista****';
                 $nombreImagen=md5(uniqid(rand(),true)).".jpg";
                 $imagen= Image::make($_FILES['imagen'.$i]['tmp_name']->resize(800, null));
                 $imagen->save(CARPETA_IMAGENES. $nombreImagen);
                 $ConteBlog[$a]->setImagen( $nombreImagen);
                 
                
              }
          }
         
          $ConteBlog[$a]->setId_blog($id_blog);
                   
          $ConteBlog[$a]->guardar($i);
          echo $i;            
     } 
     

     for($i= $secciones+1;$i<=$secciones +$seccionesNuevas;$i++){ 
       
      $ConteBlog=new ConBlog($_POST,$i);
      
      if(isset($_POST['contenido'.$i])){
          
          if(boolval($_POST['contenido'.$i])){
          $text= $_POST['contenido'.$i]; 
          $nombreText=md5(uniqid(rand(),true)).".txt";
          $fi=fopen(CARPETA_TEXTO.$nombreText,'a') or die('problemas al subir text');
          fwrite($fi,$text);
          fclose($fi);
          $ConteBlog->setTxt($nombreText);
          }
      }
      
      
       if (isset($_FILES['video'.$i]['tmp_name'])) {
          if (boolval($_FILES['imagen'.$i]['tmp_name'])) {     
          //debuguear($nombreImagen[$i]);
          $nombreVideo=md5(uniqid(rand(),true)).".mp4";              
          $video= $_FILES['video'.$i]['tmp_name']; 
          move_uploaded_file($video, CARPETA_VIDEO . $nombreVideo);
          $ConteBlog->setVideo($nombreVideo);
          }    
       }
       
        
       if(isset($_FILES['imagen'.$i]['tmp_name'])) {
         // debuguear(boolval($_FILES['imagen'.$i]['tmp_name']));
           if(boolval($_FILES['imagen'.$i]['tmp_name'])){
            
              $nombreImagen=md5(uniqid(rand(),true)).".jpg";
        
              $imagen= Image::make($_FILES['imagen'.$i]['tmp_name'])->resize(800, null);
              
              $imagen->save(CARPETA_IMAGENES. $nombreImagen);
              $ConteBlog->setImagen( $nombreImagen);
             
           }
       }
       
       $ConteBlog->setId_blog($id_blog);
      
    
       $ConteBlog->guardar($id_blog);
       //debuguear($ConteBlog);
       echo $i;            
     }
     
      header('Location: /paginaDeControl?resultado=2');    
      }
        $Datos=false;
        $Actualizar = true;
        $inicio = false;
        $auth=Autorizacion();
        $router->render('internas/actualizar', [
            'auth'=> $auth,
            'ConteBlog'=>$ConteBlog,
            'Blog'=>$Blog,
            'Actualizar'=>$Actualizar,
            'inicio'=>$inicio
        ]);

    }

}