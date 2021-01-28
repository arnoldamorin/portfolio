<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pg ?></title>
    <link rel="shortcut icon" href="images/Aa.png" type="image/x-icon">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">    
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="css/bootstrap/js/bootstrap.min.js"></script>    
    <script src="css/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body id=<?php echo $pg ?>>
    <header>
        <div class="container mb-sm-5 px-sm-3 py-sm-3">
            <nav class="navbar navbar-expand-md px-sm-0">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                    aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars text-center"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav mr-sm-auto">
                        <li class="nav-item pr-sm-5">
                            <a class="nav-link <?php echo $pg == "index"? "active px-sm-3 rounded-pill" : ""; ?> "
                                href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item pr-sm-5">
                            <a class="nav-link <?php echo $pg == "sobre-mi"? "active px-sm-3 rounded-pill" : ""; ?>"
                                href="sobre-mi.php">Sobre Mí</a>
                        </li>
                        <li class="nav-item pr-sm-5">
                            <a class="nav-link <?php echo $pg == "proyectos"? "active px-sm-3 rounded-pill" : ""; ?>"
                                href="proyectos.php">Proyectos</a>
                        </li>
                        <li class="nav-item pr-sm-5">
                            <a class="nav-link <?php echo $pg == "contacto"? "active px-sm-3 rounded-pill" : ""; ?>"
                                href="contacto.php">Contacto</a>
                        </li>
                    </ul>
                    <?php if ($pg != "sobre-mi"){?>
                    <form class="form-inline my-sm-2 my-lg-0">
                        <a href="CV_ARNOLD_AMORIN.pdf" download="CV_ARNOLD_AMORIN.pdf"class="btn-pdf">DESCARGAR MI CV <i class="fas fa-download"></i></a>
                    </form>
                    <?php }?>
                </div>
            </nav>
        </div>
    </header>
</body>
