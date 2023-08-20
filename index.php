<?php
// index.php
if (isset($_GET['url'])) {
    $ruta = $_GET['url'];
    
    // Aquí puedes agregar lógica para determinar qué vista corresponde a la ruta
    if ($ruta === 'agregarVuelo') {
        require 'views/index.php';
    } elseif ($ruta === 'login') {
        require 'views/login.php';
    } elseif ($ruta === 'listar') {
        require 'src/CListFlight.php';
        $listController = new CListFlight();
        $listController->index(); 
    }elseif ($ruta === 'editar') {
        require 'src/CListFlight.php';
        $listController = new CListFlight();
        $listController->edit($_GET['id']); 
    }elseif ($ruta === 'actualizar') {
        require 'src/CListFlight.php';
        $listController = new CListFlight();
        $listController->update(); 
    }
    elseif ($ruta === 'eliminar') {
        require 'src/CListFlight.php';
        $listController = new CListFlight();
        $listController->delete($_GET['id']); 
    }else {
        // Vista por defecto para rutas no reconocidas
        require 'views/404.php';
    }
} else {
    // Vista por defecto (puede ser la página de inicio)
    require 'views/index.php';
}
