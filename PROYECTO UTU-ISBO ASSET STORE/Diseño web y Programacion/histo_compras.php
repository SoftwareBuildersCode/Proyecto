<?php
require 'config/config.php';
require 'config/database.php';
require 'clases/clientes_funciones.php';

$db = new Database();
$con = $db->conectar();

$token = generarToken();
$_SESSION['token'] = $token; //genero dos token para mas seguridad

$id_cliente = $_SESSION['user_cliente'];
$sql = $con->prepare("SELECT id_transaccion, fecha, status, total FROM compra WHERE id_cliente=? ORDER BY DATE(fecha) DESC");
$sql->execute([$id_cliente]);
?>

<!DOCTYPE html>
<html lang="es">
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
            <h4>Historial de compras</h4>
            <hr>
            <?php while ($row = $sql->fetch(PDO::FETCH_ASSOC)){ ?>
            <div class="card mb-3 text-white bg-dark">
                <div class="card-header">
                    <?php echo $row['fecha']; ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title">ID transaccion: <?php echo $row['id_transaccion']; ?></h5>
                    <p class="card-text">Total: <?php echo $row['total']; ?></p>
                    <a href="detalles_compras.php?orden=<?php echo $row['id_transaccion']; ?>&token=<?php echo $token; ?> " 
                    class="btn btn-success">Detalles compra</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
