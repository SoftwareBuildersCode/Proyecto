<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id == '' || $token == '') {
    echo 'Error al cargar la página';
    exit;
} else {
    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);
    if ($token == $token_tmp) {
        $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
        $sql->execute([$id]);

        if ($sql->fetchColumn() > 0) {
            $sql = $con->prepare("SELECT nombre, descripcion, precio, descuento FROM productos WHERE id=? AND activo=1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $precio = $row['precio'];
            $descuento = $row['descuento'];
            $precio_descuento = $precio - (($precio * $descuento) / 100);
            $dir_images = 'img/productos/' . $id . '/';

            $rutaImg = $dir_images . 'producto.jpg';
            if (!file_exists($rutaImg)) {
                $rutaImg = 'img/no-photo.jpg';
            }

            $imagenes = array();
            $dir = dir($dir_images);

            while (($archivo = $dir->read()) !== false) {
                if ($archivo != 'principal.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))) {
                    $imagenes[] = $dir_images . $archivo;
                }
            }
            $dir->close();
        }

        $sqlCaracter = $con->prepare("SELECT DISTINCT(det.id_carateristicas) AS idCat, caract.caracteristica 
                                      FROM det_productos_caracteristicas AS det 
                                      INNER JOIN caracteristicas AS caract ON det.id_carateristicas=caract.id
                                      WHERE det.id_producto=?");
        $sqlCaracter->execute([$id]);
    } else {
        echo 'Error al cargar la página';
        exit;
    }
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
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<?php include 'menu.php'; ?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-md-6 order-md-1">
                <div id="carruselImages" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo $rutaImg; ?>" class="d-block w-100" alt="Producto">
                        </div>
                        <?php foreach ($imagenes as $img) { ?>
                            <div class="carousel-item">
                                <img src="<?php echo $img; ?>" class="d-block w-100" alt="Producto adicional">
                            </div>
                        <?php } ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carruselImages" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carruselImages" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-md-6 order-md-2">
                <h2><?php echo $nombre; ?></h2>
                <?php if ($descuento > 0) { ?>
                    <p><del><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></del></p>
                    <h2>
                        <?php echo MONEDA . number_format($precio_descuento, 2, '.', ','); ?>
                        <small class="text-success"><?php echo $descuento; ?> % descuento</small>
                    </h2>
                <?php } else { ?>
                    <h2><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></h2>
                <?php } ?>

                <p class="lead">
                    <?php echo $descripcion; ?>
                </p>

                <div class="col-3 my-3">
                    <?php 
                        while($row_cat = $sqlCaracter->fetch(PDO::FETCH_ASSOC)){
                            $idCat = $row_cat['idCat'];
                            echo $row_cat['caracteristica']. ":";
                            echo "<select class='form-select' id='cat_".$idCat."'>";
                            $sqlDet = $con->prepare("SELECT id, valor, stock FROM det_productos_caracteristicas WHERE id_producto=? AND id_carateristicas=?");
                            $sqlDet->execute([$id, $idCat]);
                            while($row_det = $sqlDet->fetch(PDO::FETCH_ASSOC)){ 
                                echo "<option id='" . $row_det['id'] . "'>" . $row_det['valor'] . "</option>";
                            }
                            echo "</select>";
                        }
                    ?>
                </div>

                <div class="d-grid gap-3 col-12 mx-auto">
                    <button class="btn btn-success" type="button">Comprar ahora</button>
                    <button class="btn btn-outline-secondary" type="button" onclick="agregarProducto(<?php echo $id; ?>, '<?php echo $token_tmp; ?>')">Agregar al carrito</button>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/agregarProductos.js"></script>

</body>

</html>
