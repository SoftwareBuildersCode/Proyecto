<?php
require '../config/config.php';
require '../config/database.php';

header('Content-Type: application/json');

$datos = ['ok' => false];

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $id = isset($_POST['id']) ? $_POST['id'] : 0;

    if($action == 'agregar') {
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
        $respuesta = agregar($id, $cantidad);
        if($respuesta > 0){
            $datos['ok'] = true;
            $datos['sub'] = MONEDA . number_format($respuesta, 2, '.', ',');
        } else {
            $datos['ok'] = false;
            $datos['error'] = 'No se pudo agregar el producto';
        }
    } else {
        $datos['ok'] = false;
        $datos['error'] = 'Acción no válida';
    }
} else {
    $datos['ok'] = false;
    $datos['error'] = 'No se recibió ninguna acción';
}

echo json_encode($datos);

function agregar($id, $cantidad){
    $res = 0;
    if($id > 0 && is_numeric($cantidad)){
        if(isset($_SESSION['carrito']['productos'][$id])){
            $_SESSION['carrito']['productos'][$id] = $cantidad;

            $db = new Database();
            $con = $db->conectar();
            $sql = $con->prepare("SELECT precio, descuento FROM productos WHERE id=? AND activo=1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $precio = $row['precio'];
                $descuento = $row['descuento'];
                $precio_descuento = $precio - (($precio * $descuento) / 100);
                $res = $cantidad * $precio_descuento;
            }
        }
    }
    return $res;
}
?>
