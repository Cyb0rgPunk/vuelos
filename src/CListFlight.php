<?php

class CListFlight
{
    private $dbconn;

    public function __construct()
    {
        // Incluir el archivo de configuración de la base de datos
        require_once __DIR__ . '/../config/db.php';

        // Obtener la conexión desde el archivo de configuración
        $this->dbconn = obtenerConexionDB();
    }
    
    public function index()
    {

        $sql = "SELECT * FROM vuelos";
        $result = pg_query($this->dbconn, $sql);
        
        // Verificar si se obtuvieron resultados
        if ($result) {
            $vuelos = pg_fetch_all($result);

            // Cargar la vista de listar con los datos
            require __DIR__ . '/../views/list.php';
        } else {
            return [];
        }      
        
    }

    public function edit($id){

        $sql = "SELECT * FROM vuelos WHERE vuelos.id = $id";
        $result = pg_query($this->dbconn, $sql);
        //var_dump(pg_fetch_all($result));
        $vuelo = pg_fetch_all($result);
        require __DIR__ . '/../views/edit.php';

    }

    public function update(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $id = $_POST['id'];
            $fecha = pg_escape_string($_POST['fecha']);
            $horaSalida = pg_escape_string($_POST['horaSalida']);
            $horaLlegada = pg_escape_string($_POST['horaLlegada']);
            $duracion = pg_escape_string($_POST['duracion']);
            $tipoTrayecto = pg_escape_string($_POST['tipoTrayecto']);
            $costo = pg_escape_string($_POST['costo']);
        
            // Construir la consulta SQL de actualización
            $sql = "UPDATE vuelos SET
                    fecha_vuelo = '$fecha',
                    hora_salida = '$horaSalida',
                    hora_llegada = '$horaLlegada',
                    duracion_trayecto = '$duracion',
                    tipo_trayecto = '$tipoTrayecto',
                    costo_vuelo = '$costo'
                    WHERE id = $id";
        
            // Ejecutar la consulta
            $result = pg_query($this->dbconn, $sql);
        
            if ($result) {
                echo "Datos actualizados correctamente en la base de datos.";
            } else {
                echo "Error al actualizar los datos en la base de datos.";
            }
        
            // Cerrar la conexión
            pg_close($this->dbconn);
        
            // Redireccionar a la vista de listar
            header("Location: /technokey-vuelos/listar");
            
        }
    }

    
    public function delete($id){

        $sql = "DELETE FROM vuelos WHERE id = '$id'";

        $result = pg_query($this->dbconn, $sql);

        if ($result) {
            echo "Registro eliminado correctamente.";
            // Redireccionar a la ruta deseada
            header("Location: /technokey-vuelos/listar"); // Cambia "/technokey-vuelos/listar" por la ruta que desees
        } else {
            echo "Error al eliminar el registro.";
        }

        // Cerrar la conexión
        pg_close($this->dbconn);
    }
}
