<?php

// Incluir el archivo de configuración de la base de datos
require_once '../config/db.php';

// Obtener la conexión desde el archivo de configuración
$dbconn = obtenerConexionDB();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $errors = [];

    // Validar el campo Fecha del Vuelo
    if (empty($_POST['fecha'])) {
        $errors[] = 'El campo Fecha del Vuelo es requerido.';
    }

    // Validar el campo Hora de Salida
    if (empty($_POST['horaSalida'])) {
        $errors[] = 'El campo Hora de Salida es requerido.';
    }

    // Validar el campo Hora de Llegada
    if (empty($_POST['horaLlegada'])) {
        $errors[] = 'El campo Hora de Llegada es requerido.';
    }

    // Validar el campo Duración del Trayecto
    if (empty($_POST['duracion'])) {
        $errors[] = 'El campo Duración del Trayecto es requerido.';
    }

    // Validar el campo Tipo de Trayecto
    if (empty($_POST['tipoTrayecto'])) {
        $errors[] = 'El campo Tipo de Trayecto es requerido.';
    }

    // Validar el campo Costo del Vuelo
    if (empty($_POST['costo'])) {
        $errors[] = 'El campo Costo del Vuelo es requerido.';
    }


    // Si no hay errores, procesar los datos
    if (empty($errors)) {
        // Extraer variables del arreglo $_POST
        extract($_POST, EXTR_PREFIX_ALL, 'input');

        if (!$dbconn) {
            echo "Error de conexión a la base de datos.";
        } else {
            // Escapar los valores para evitar SQL Injection
            $fecha = pg_escape_string($input_fecha);
            $horaSalida = pg_escape_string($input_horaSalida);
            $horaLlegada = pg_escape_string($input_horaLlegada);
            $duracion = pg_escape_string($input_duracion);
            $tipoTrayecto = pg_escape_string($input_tipoTrayecto);
            $costo = pg_escape_string($input_costo);
    
            // Construir la consulta SQL
            $sql = "INSERT INTO vuelos (fecha_vuelo, hora_salida, hora_llegada, duracion_trayecto, tipo_trayecto, costo_vuelo)
                    VALUES ('$fecha', '$horaSalida', '$horaLlegada', '$duracion', '$tipoTrayecto', '$costo')";
    
            // Ejecutar la consulta
            $result = pg_query($dbconn, $sql);
    
            if ($result) {
                echo "Datos insertados correctamente en la base de datos.";
            } else {
                echo "Error al insertar los datos en la base de datos.";
            }
    
            // Cerrar la conexión
            pg_close($dbconn);
            require '../views/list.php';
        }


    }else{
        echo "ERRORES!";
        require '../views/index.php';
    }
}
?>