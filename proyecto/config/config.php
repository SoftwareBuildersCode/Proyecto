<?php
define("CLIENT_ID","AZ2uzvkQjGYxPdZZIJM13dOkd4mjYeO3ipG7CFIWnd-34fWdVj_OtnOQCoreweD0ihl6oxPKTPuoft2Q");
define("KEY_TOKEN", "USD");
define("CURRENCY", "S.B.C.1891");
define("MONEDA", "$");

session_start();

$num_cart = 0;
if(isset(($_SESSION['carrito']['productos']))){
    $num_cart = count($_SESSION['carrito']['productos']);
}
?>