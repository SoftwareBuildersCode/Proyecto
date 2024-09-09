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
                <a href="tienda.php" class="navbar-brand d-flex align-items-center">
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
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" 
                                    id="btn_session" data-bs-toggle="dropdown" 
                                    aria-expanded="false">
                                    <i class="fas fa-user"></i> <?php echo $_SESSION['user_name']; ?>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btn_session">
                                <li><a class="dropdown-item" href="logout.php">Cerrar sesion</a></li>
                                <li><a class="dropdown-item" href="histo_compras.php">Historial de compras</a></li>
                            </ul>
                        </div>
                    <?php } else { ?>
                        <a href="login.php" class="btn btn-sm btn-secondary">
                            <i class="fas fa-user"></i> Ingresar
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>
</body>
