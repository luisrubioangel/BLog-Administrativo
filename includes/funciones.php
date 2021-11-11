<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . '/funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../public/imagenes/');
define('CARPETA_VIDEO', __DIR__ . '/../public/video/');
define('CARPETA_TEXTO', __DIR__ . '/../public/texto/');

function incluirTemplate($nombre, $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}
function estaAutenticado()
{
    session_start();

    if (!$_SESSION['login']) {
        header('Location:/');
    }
}
function debuguear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
//Escapa /sanitizar
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}
function vaidarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}
//muestra el mensaje
function mostrarNotificacion($codigo)
{
    $mensaje = '';
    switch ($codigo) {
        case 1:
            $mensaje = 'Creando Correctamente';
            break;
        case 2:
            $mensaje = 'Actulizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}
function validarORedireccionar(string $url)
{
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header("Location: ${url}");
    }
  return $id;
}
function Autorizacion(){
    if(!isset($_SESSION)){
        session_start();
       
    };
    $auth = $_SESSION['login'] ?? false;
    
   // debuguear( $auth);
    return $auth;
}
function mesajeControl($int){
    
    $mensaje='';
 if ($int==1) {
    $mensaje ='Cuenta Creada Correctamente';
 }elseif($int==2){
    $mensaje ='Blog Actualizado correctamente';
 }elseif($int==3){
    $mensaje ='Blog Creado correctamente';
 }elseif($int==4){
    $mensaje ='Eliminado correctamente';
 }elseif($int==5){
    $mensaje ='Bienvenido nuevo autor';
 }
 else{
     $mensaje='Bienvenido a la pagina de control';
 }
 return $mensaje;
}