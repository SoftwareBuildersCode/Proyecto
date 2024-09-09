<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();

if ($productos != null) {
    foreach ($productos as $clave => $cantidad) {
        $sql = $con->prepare("SELECT id, nombre, precio, descuento, $cantidad AS cantidad FROM productos WHERE id=? AND activo=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
}

//session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<?php include 'menu.php'; ?>
<main>
    <div class="container">
      <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if($lista_carrito == null){
                    echo '<tr><td  colspan="5" class="text-center"><b>Vacio</b></td></tr>';
                }else{
                    $total = 0;
                    foreach($lista_carrito as $producto){
                        $_id = $producto['id'];
                        $nombre = $producto['nombre'];
                        $precio = $producto['precio'];
                        $descuento = $producto['descuento'];
                        $cantidad = $producto['cantidad'];
                        $precio_descuento = $precio - (($precio * $descuento)/ 100);
                        $subtotal = $cantidad * $precio_descuento;
                        $total += $subtotal;
                        
                    ?>
            
                <tr>
                    <td>
                        <?php echo $nombre; ?>
                    </td>
                    <td>
                    <?php echo MONEDA . number_format($precio_descuento, 2, '.', ','); ?>

                    </td>
                    <td>
                        <input type="number" mi="1" max="10" step="1" value="<?php echo $cantidad ?>"
                        size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizar(this.value, <?php echo $_id; ?>)">
                    </td>
                    <td>
                        <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal,2, '.', ','); ?></div>
                    </td>
                    <td>
                    <a href="#" id="eliminar" class="btn btn-danger btn-sm" data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a>

</td>
</tr>
<?php } ?>
<tr>
    <td colspan="3"></td>
    <td colspan="2">
        <p class="h3" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
    </td>
</tr>
</tbody>
<?php } ?>
</table>
</div>
<?php if($lista_carrito != null){ ?>
<div class="row">
    <div class="col-md-5 offset-md-7 d-grid gap-2">
        <?php if(isset($_SESSION['user_cliente'])){ ?>
            <a href="pagos/pago.php"class="btn btn-success btn-lg">Pagar </a>
        <?php }else{ ?>
            <a href="login.php?pago"class="btn btn-success btn-lg">Pagar </a>
        <?php } ?>
    </div>
</div>
<?php } ?>
</div>
</main>
<div class="modal fade" id="eliminaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminaModalLabel">Alerta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Esta seguro de eliminar este producto?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button id="btn-elimina" type="button" class="btn btn-danger" onclick="eliminar()">Eliminar</button>
      </div>
    </div>
  </div>
</div>

                        
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/actualizarProductos.js"> 
</script>
</body>
</html>
