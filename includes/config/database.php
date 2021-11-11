<?php
function conectarDB()
{
    //$db = mysqli_connect("4idtech.com", "idtechco_idtechc", "WTk_4pRsEiP%", "idtechco_4fourid");
   $db = mysqli_connect("localhost", "root", "root", "pagina");
    if (!$db) {
        echo "Error+++ no se pudeo conectar";
        exit;
    }
    return $db;
}
