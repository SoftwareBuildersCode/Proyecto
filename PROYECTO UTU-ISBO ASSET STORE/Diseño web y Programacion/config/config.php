<?php
define('SITE_URL', 'http://localhost/proyecto');

define("CLIENT_ID","AZ2uzvkQjGYxPdZZIJM13dOkd4mjYeO3ipG7CFIWnd-34fWdVj_OtnOQCoreweD0ihl6oxPKTPuoft2Q");
define("KEY_TOKEN", "UYU");
define("CURRENCY", "S.B.C.1891");
define("MONEDA", "$");
date_default_timezone_set('America/Montevideo');


define("MAIL_HOST","smtp.gmail.com");
define("MAIL_USER","nachoserpa1@gmail.com");
define("MAIL_PASS","uusq qlbq aurd fvxg");
define("MAIL_PORT","465");

session_start();

$num_cart = 0;
if(isset(($_SESSION['carrito']['productos']))){
    $num_cart = count($_SESSION['carrito']['productos']);
}
$user_name = '';

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
}
?>