<?php
require '../config/config.php';
require '../config/database.php';
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
} else {
    header("location: ../tienda.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../css/styles.css" rel="stylesheet">
</head>
<body>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/348f0f7040.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a href="../tienda.php" class="navbar-brand d-flex align-items-center">
                    <strong class="custom-color">ASSET Store</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#navbarHeader" aria-controls="navbarHeader" 
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">Catálogo</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Contacto</a>
                        </li>
                    </ul>
                    
                    <a href="checkout.php" class="btn btn-sm btn-success">
                        <i class="fa-solid fa-cart-shopping"></i> Carrito 
                        <span id="num_cart" class="badge bg-outline-success">
                            <?php echo $num_cart; ?>
                        </span>
                    </a>

                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <div class="dropdown">
                            <button class="btn btn-success btn-sm dropdown-toggle" type="button" 
                                    id="btn_session" data-bs-toggle="dropdown" 
                                    aria-expanded="false">
                                    <i class="fas fa-user"></i> <?php echo $_SESSION['user_name']; ?>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btn_session">
                                <li><a class="dropdown-item" href="logout.php">Cerrar sesion</a></li>
                            </ul>
                        </div>
                    <?php } else { ?>
                        <a href="login.php" class="btn btn-sm btn-success">
                            <i class="fas fa-user"></i> Ingresar
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>
</body>

<main>
    <div class="container">
        <div class ="row">
            <div class= "col-6">
                <h4>Detalles del pago </h4>
                <div id="paypal-button-container"></div>
            </div>
            
        <div class="col-6">
        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Subtotal</th>
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
                        <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal,2, '.', ','); ?></div>
                    </td>
                </tr>
<?php } ?>
<tr>
    <td colspan="2">
        <p class="h3 text-end" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
    </td>
</tr>
</tbody>
<?php } ?>
</table>
</div>
</div>
</main>               
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=USD"></script>

<script>
    paypal.Buttons({
    style: {
        color: 'blue',
        shape: 'pill',
        label: 'pay'
    },
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: <?php echo $total; ?>
                }
            }]
        });
    },
    onApprove: function(data, actions){
        let URL = '../clases/captura.php';
        actions.order.capture().then(function(detalles) {
        let urlCaptura = '../clases/captura.php';
            return fetch(urlCaptura, {
                method: 'post',
                headers: {
                    'content-type': 'application/json'
                },
                body: JSON.stringify({
                    detalles: detalles
                })
            }).then(function(response){
                window.location.href = "../completado.php?key=" + detalles['id'];

            })
        });
    },

    onCancel: function(data){
        alert("Pago cancelado");
        console.log(data)
    }
}).render('#paypal-button-container');

</script>
</body>
</html>
