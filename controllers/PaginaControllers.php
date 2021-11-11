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

class PaginaControllers
{
    public static function index(Router $router)
    {   // $auth=new Admin();0
       
          
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            debuguear('post de index');
            $respuestas=$_POST;
            //debuguear($respuestas);
            $mail=new PHPMailer();
            $mail->isSMTP();
            $mail->Host='smtp.mailtrap.io';
            $mail->SMTPAuth=true;
            $mail->Username='592d8dc5a4948a';
            $mail->Password='cc5ec442d4668c';
            $mail->SMTPSecure='tls';
            $mail->Port=2525;
            //
            $mail->setFrom($respuestas["email"]);
            $mail->addAddress('4idtech@gmail.com','4fourId.com');
            $mail->Subject='Tienes un Nuevo Mensaje';
            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet='UTF_8';
            //Definir el contenido
            //debuguear($respuestas);
            $contenido='<html>';
            $contenido.='<p>Tienes un nuevo mensaje</p>';
            $contenido.='<p>Nombre: '.$respuestas["name"].'<br>';
            $contenido.='Corroe: '.$respuestas["email"] .'<br>';
            $contenido.='Asunto: '.$respuestas["subject"] .'<br>';
            $contenido.='Mensaje: '.$respuestas["message"] .'<br>';
            $contenido.='</p>';
            $contenido.='</html>';
            $mail->Body=$contenido;
            $mail->AltBody='Este es texto alternativo sin HTML';

            //Eviar el email
            $destino='luisrubioangel.2011@gmail.com';
            $asunto=$respuestas["subject"];
            $mensaje='Nombre: '.$respuestas["name"].'
            '.'Mensaje: '.$respuestas["message"];
            $desde=$respuestas["email"];
            mail($destino,$asunto,$mensaje,$desde);
            
            $mail->send();


           debuguear('envio de mensaje');

        }
        $auth=Autorizacion();

         $Blog=Blogs::getcantidad(3);
        $cantidad=0;
        foreach($Blog as $blog){
            $cantidad=$cantidad+(int)$blog->Secciones;
        }
        $ConteBlog=ConBlog::getcantidad($cantidad);
        
        //debuguear($ConteBlog);
       
        $Datos=false;
        $inicio = true;
        $header = true;
        $servi=false;
        $router->render('paginas/index', [
            'auth'=>$auth,
            'Blog'=>$Blog,
            'ConteBlog'=>$ConteBlog,
            'Dato'=>false,
             'Datos'=>$Datos,
            'inicio' => $inicio,
            'header' => $header,
            'servicios' => $servi,
            'session'=>false,
            'inicio_session'=>false,
            'registro'=>false,
            'js'=>false
        ]);
    }
   
    public static function paginaDeControl(Router $router){
        
        
        $ID_mensaje=ActiveRecord::mensaje();
        $mensaje=mesajeControl($ID_mensaje);
        //debuguear('holaaaaaaaaaaaaa');
       // debuguear($mensaje);
        
        $Datos=false;
        $servi = true;
        $inicio = false;
        $Blogs=Blogs::all();
        $auth=Autorizacion();

        $router->render('internas/admin-index', [
            'mensaje'=>$mensaje,
            'auth'=>$auth,
            'Blogs'=>$Blogs,
            'Dato'=>true,
            'Datos'=>$Datos,
            'inicio' => $inicio,
            'registro'=>false,
            'session' =>false,
            'js'=>false

        ]);
        

    }
    public static function eliminar(Router $router){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           $id=$_POST['id'];
           $id=filter_var($id,FILTER_VALIDATE_INT);
           if ($id) {
            $Blog=Blogs::find($id);
            $ConteBlog=ConBlog::find_blog_id($id,'blog_id','blogs');
            $Blog->eliminar();
            for($i=0;$i< count($ConteBlog);$i++){
                $ConteBlog[$i]->eliminar();
            }
           }
          
        }
    
    }
    
    
}
