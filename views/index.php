<!-- views/mi_vista.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Vuelos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    
    <div class="container">
        <?php include 'menu.php'; ?>
    </div>

    <div class="container">
        <!-- Formulario -->
        <form action="/technokey-vuelos/src/CInsertFlight.php" method="POST">
            <div class="form-group">
                <label for="fecha">Fecha del Vuelo</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo isset($_POST['fecha']) ? $_POST['fecha'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="horaSalida">Hora de Salida</label>
                <input type="time" class="form-control" id="horaSalida" name="horaSalida" value="<?php echo isset($_POST['horaSalida']) ? $_POST['horaSalida'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="horaLlegada">Hora de Llegada</label>
                <input type="time" class="form-control" id="horaLlegada" name="horaLlegada" value="<?php echo isset($_POST['horaLlegada']) ? $_POST['horaLlegada'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="duracion">Duración del Trayecto</label>
                <input type="text" class="form-control" id="duracion" name="duracion" value="<?php echo isset($_POST['duracion']) ? $_POST['duracion'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="tipoTrayecto">Tipo de Trayecto</label>
                <select class="form-control" id="tipoTrayecto" name="tipoTrayecto" value="<?php echo isset($_POST['tipoTrayecto']) ? $_POST['tipoTrayecto'] : ''; ?>" required>
                    <option>Seleccione...</option>
                    <option value='1'>Ida</option>
                    <option value='2'>Vuelta</option>
                    <option value='3'>Ida y vuelta</option>
                </select>
            </div>
            <div class="form-group">
                <label for="costo">Costo del Vuelo</label>
                <input type="text" class="form-control" id="costo" name="costo" value="<?php echo isset($_POST['costo']) ? $_POST['costo'] : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger mt-3">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            // Obtener elementos del formulario
            var horaSalidaInput = document.getElementById("horaSalida");
            var horaLlegadaInput = document.getElementById("horaLlegada");
            var duracionInput = document.getElementById("duracion");

            // Deshabilitar edición en el campo de duración
            duracionInput.readOnly = true;

            // Agregar evento para calcular la duración al cambiar la hora de salida o llegada
            horaSalidaInput.addEventListener("change", calcularDuracion);
            horaLlegadaInput.addEventListener("change", calcularDuracion);

            function calcularDuracion() {
                var horaSalida = new Date("1970-01-01T" + horaSalidaInput.value + "Z");
                var horaLlegada = new Date("1970-01-01T" + horaLlegadaInput.value + "Z");

                // Calcular la diferencia en milisegundos
                var diferenciaMilisegundos = Math.abs(horaLlegada - horaSalida);

                // Convertir la diferencia en horas y minutos
                var horas = Math.floor(diferenciaMilisegundos / 3600000);
                var minutos = Math.floor((diferenciaMilisegundos % 3600000) / 60000);

                // Actualizar el campo de duración
                duracionInput.value = horas + " horas " + minutos + " minutos";
            }
        });
    </script>
    
</body>
</html>
