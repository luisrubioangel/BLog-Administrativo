<?php

namespace Model;

class Admin extends ActiveRecord
{
    //Base de datos
    protected static $tabla = 'user';
    protected static $columnasDB = ['user_id', 'user_email', 'user_password','user_name','user_lastname','user_photo','user_cargo'];
///variabes de la base de datos
    public $password = '';
    public $password_r = '';
    public $username = '';
    public $id;
    public $email;
    public $lastname;
    public $imagen;
    public $cargo;

    public function __construct($args = [])
    {
        $this->id = $args['user_id'] ?? null;
        $this->email = $args['email'] ?? 'x';
        $this->password = $args['password'] ?? '';
        $this->username = $_POST['name'] ?? '';
        $this->lastname = $_POST['last-name'] ?? '';
        $this->password_r = $_POST['password_r'] ?? '';
       // $this->photo=$_POST['']??'';
        $this->cargo=$_POST['Cargo']??'';
    }
    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = 'El Email es obligatorio';
        }
        if (!$this->password) {
            self::$errores[] = 'El password es obligatorio';
        }
      
        if($this->password_r){
         if($this->password_r !== $this->password){
            self::$errores[] = 'Los passwords no son iguales';
         }
        }

        return self::$errores;
    }
    public function existeUsuario()
    {
        //REvisar si un usuario existe o no
        $query = "SELECT*FROM " . self::$tabla . " WHERE user_email='" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        

        if (!$resultado->num_rows) {
            self::$errores[] = 'EL Usuario no existe';

            return;
        }
        return $resultado;
    }
    public function comprobarPassword($resultado)
    {

        $usuario = $resultado->fetch_object();
       
        $autenticado = password_verify($this->password, $usuario->user_password);

        if (!$autenticado) {
            // DEBUG:

            self::$errores[] = 'El password esta incorrecto';
        }

        return [$autenticado,$usuario];
    }
    public function autenticar($usuario)
    {    
        session_start();
        //Llenar el arreglo de session
        $_SESSION['usuario'] = $this->email;
        $_SESSION['name']=$usuario->user_name;
        $_SESSION['login'] = true;
        header('Location:/paginaDeControl');
    }
    public function Registro()
    {     
        
        $passwordHash = password_hash($this->password, PASSWORD_BCRYPT);
        $query = " INSERT INTO user (user_email,user_password,user_name,user_lastname,user_photo,user_cargo)";
        $query.=" VALUES ( '$this->email', '$passwordHash','$this->username','$this->lastname','$this->imagen','$this->cargo')";
        
        // DEBUG:
        
    
        $resultado = self::$db->query($query);
        if(!isset($_SESSION)){
            session_start();
           
        };
     
        //Llenar el arreglo de session
        $_SESSION['usuario'] = $this->email;
        $_SESSION['name']=$this->name;
        $_SESSION['login'] = true;
       // debuguear($resultado);
        header('Location:/paginaDeControl?resultado=5');
      
        return $resultado;
    }
    static public function getautor($id){
        
        $query = "SELECT*FROM " . self::$tabla . " WHERE user_id='" . $id . "' LIMIT 1";
        //debuguear($query);
        $resultado = self::$db->query($query);
        $usuario = $resultado->fetch_object();
        //debuguear($usuario);
        return $usuario;
    }
    static public function getautorenseccion($email){
        
        $query = "SELECT*FROM " . self::$tabla . " WHERE user_email='" . $email . "' LIMIT 1";
        //debuguear($query);
        $resultado = self::$db->query($query);
        $usuario = $resultado->fetch_object();
        //debuguear($usuario);
        return $usuario;
    }
}
