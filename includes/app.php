<?php
require 'funciones.php';
require 'config/database.php';
require 'config/databasePOD.php';
require __DIR__ . '/../vendor/autoload.php';
$db = conectarDB();
$connect=conectarDBPDO();


use Model\ActiveRecord;

//var_dump($propiedad);

ActiveRecord::setDB($db);
