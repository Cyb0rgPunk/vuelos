<!DOCTYPE html>
<html>

<head>
    <title>Listar Vuelos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>

<body>

    <!-- Incluir el contenido del menú -->

    <div class="container">
        <?php include 'menu.php'; ?>
    </div>

    <div class="container mt-4">
        <h2>Listado de Vuelos</h2>
        <table id="tablaVuelos" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Hora de Salida</th>
                    <th>Hora de Llegada</th>
                    <th>Duración</th>
                    <th>Tipo de Trayecto</th>
                    <th>Costo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($vuelos as $vuelo): ?>
                <tr>
                    <td><?php echo $vuelo['id']?></td>
                    <td><?php echo $vuelo['fecha_vuelo']?></td>
                    <td><?php echo $vuelo['hora_salida']?></td>
                    <td><?php echo $vuelo['hora_llegada']?></td>
                    <td><?php echo $vuelo['duracion_trayecto']?></td>
                    <td> 
                        <?php
                            $tipoTrayecto = $vuelo['tipo_trayecto'];
                            if ($tipoTrayecto === '1') {
                                echo 'Ida';
                            } elseif ($tipoTrayecto === '2') {
                                echo 'Vuelta';
                            } elseif ($tipoTrayecto === '3') {
                                echo 'Ida y vuelta';
                            }
                        ?>
                    </td>
                    <td><?php echo "$".$vuelo['costo_vuelo']?></td>

                    <td>
                        <a href="<?php echo 'http://127.0.0.1/technokey-vuelos/editar?id='.$vuelo['id'];?>"
                            class="btn btn-primary" type="button">Editar</a>
                        <a href="<?php echo 'http://127.0.0.1/technokey-vuelos/eliminar?id='.$vuelo['id'];?>"
                            class="btn btn-danger" type="button">Eliminar</a>
                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#tablaVuelos').DataTable();
    });
    </script>

</body>

</html>