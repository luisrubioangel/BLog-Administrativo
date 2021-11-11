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

class CuentasControllers{
    public static function admin(Router $router)
    {
       
        $errores = [];
        $autentificado = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $auth = new Admin($_POST);
            $errores = $auth->validar();       
            
            if (empty($errores)) {
                //verificar si el usuario


                $resultado = $auth->existeUsuario();
                
             
               
                if (!$resultado) {
                    $errores = Admin::getErrores();
                    
                    // debuguear($errores);
                } else {
                    //Verificar el password
                    $autentificado = $auth->comprobarPassword($resultado);
                }
                if ($autentificado[0]) {
                    //aUTENTIFICAR AL USUARIO
                    //debuguear('jho');
                    $auth->autenticar($autentificado[1]);
                  
                } else {
                    //Password incorrecto
                    $errores = Admin::getErrores();
                }
            }
            
        }
        $auth=false;
        $Datos=false;
        $servi = true;
        $inicio = false;
        $router->render('internas/admin', [
            'errores'=>$errores,
            'auth'=>$auth,
            'Dato'=>true,
            'Datos'=>$Datos,
            'inicio' => $inicio,
            'registro'=>false,
            'session' =>false,
            'js'=>false

        ]);

    }

    public static function registrar(Router $router)
    {
        

        $Datos=false;
        $errores='';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          
           
            $autor = new Admin($_POST);
            $errores = $autor->validar();
           
            if(isset($_FILES['imagen-photo']['tmp_name'])) {
                
                  if(boolval($_FILES['imagen-photo']['tmp_name'])){
                     $nombreImagen=md5(uniqid(rand(),true)).".jpg";
                     $imagen= Image::make($_FILES['imagen-photo']['tmp_name'])->resize(800, null);
                     $imagen->save(CARPETA_IMAGENES. $nombreImagen);
                     $autor->setImagen($nombreImagen);
                  
                    
                  }
              }
              //debuguear($errores);
            if (empty($errores)) {
                
                $registar = $autor->Registro();
            }
           // debuguear($errores);
        }

        $registro = true;
        $inicio = false;
        $auth=Autorizacion();
        $router->render('internas/registrar', [
            'errores'=>$errores,
            'auth'=>$auth,
            'registro' => $registro,
            'inicio' => $inicio,
            'session'=>false,
            'inicio_session'=>false,
            'js'=>false

        ]);
    } 
   
    public static function logout(Router $router)
    { 
    
        session_start();
        $_SESSION=[];
       header('Location: /');
    }

    
}