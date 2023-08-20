<?php

function obtenerConexionDB() {
    $dbconn = pg_connect("host=localhost port=5432 dbname=vuelos user=postgres password=qwerty2023");

    if ($dbconn) {

    //echo 'Connection succeeded.';
    
    } else {
    
    //echo 'Connection failed.';
    
    }
    return $dbconn;
}



?>