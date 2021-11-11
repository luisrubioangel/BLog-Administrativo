<?php

namespace MCV;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];
    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn)
    {

        $this->rutasPOST[$url] = $fn;
    }
    public function comprobarRutas()
    { 
        session_start();
        $auth = $_SESSION['login'] ?? null;
        //Arreglo de rutas protefi...
        $rutas_protegidas = ['/paginaDeControl','/crear','/actualizar'];
       // $urlActual = $_SERVER['REQUEST_URI'] ?? '/';
        $urlActual = explode('?', $_SERVER['REQUEST_URI'], 2) ?? '/';
      // $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];
        //debuguear($metodo);
      
        if ($metodo === 'GET') {
            
            $fn = $this->rutasGET[$urlActual[0]] ?? null;
           
        } else { //debuguear($_POST);
            //debuguear($metodo);
            $fn = $this->rutasPOST[$urlActual[0]] ?? null;
        }
        //proteger rutas
        if (in_array($urlActual[0], $rutas_protegidas) && !$auth) {
            header('Location: /');
        }
        if ($fn) {
            //Laa UIrl Existe y hay funcion asociada
            call_user_func($fn, $this);
            //debuguear($this);
        } else {
            echo "página No Encotrada ****";
        }
    }
    //Muestra una vista
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        ob_start(); //almaceinamiento en memoria durante el momento
        //echo "hola";
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); //limpia el
        include __DIR__ . "/views/layout.php";
    }
}
