<?php 
    function head($ua = null){
		!is_null($ua) ? $ua->sessionValidate() : null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PPW/Ejercicio4xime/resources/css/style.css">
    <link rel="stylesheet" href="/PPW/Ejercicio4xime/resources/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/PPW/Ejercicio4xime/resources/img/favicon.ico">
    <style>body{font-family:'Roboto',serif;}</style>
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app" class="container-fluid p-0">
        <header class="row m-0 bg-light">
            <div class="col-9">
                <h1 class="ml-3 mt-2 rainbow">Blog emo punketo rockerito</h1>
            </div>
            <div class="col-3">   
                <form class="d-flex mt-3" role="search">
                    <input class="form-control me-2" id="buscar-palabra" type="search" placeholder="Buscar..." aria-label="Search">
                    <button class="btn btn-outline-success" type="button" onclick="app.buscarPalabra()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg></button>
                </form>             
            </div>
        </header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Bienvenid@</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php if(!is_null($ua) && $ua->sv){ ?>
                            <li class="nav-item">
                                <button type="button" class="nav-link btn btn-link" aria-current="page" 
                                    onclick="app.view('home')">Inicio
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link btn btn-link" aria-current="page" 
                                    onclick="app.view('newpost')">Nueva Publicaci&oacute;n
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link btn btn-link" aria-current="page" 
                                    onclick="app.view('myposts')">Mis publicaciones
                                </button>
                            </li>
                        <?php } ?>

                        <?php if(is_null($ua) || !$ua->sv){ ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                            </li>
                            <li class="nav-item">
                            <!--<a class="nav-link" href="#">Cerrar</a>-->
                            <button type="button" class="nav-link btn btn-link" onclick="app.view('inisession')">Iniciar Sesi&oacute;n</button>
                            </li>

                        <?php } else { ?>

                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?=$ua->name?>
                            </a>
                            <ul class="dropdown-menu">
                                <!--<li><a class="dropdown-item" href="/PPW/Ejercicio4xime/resources/views/auth/login.php">Iniciar sesión</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#" style="color:red;">Cerrar sesión</a></li>-->
                                <li><button type="button" class="dropdown-item btn btn-link" onclick="app.view('endsession')">Cerrar sesión</button></li>
                            </ul>
                            </li>

                        <?php } ?>

                        <li class="nav-item">
                        <a class="nav-link disabled">xmc 2023 ®</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
<?php
    }//head
    
    function scripts($script=""){
?>
    </div> 
    <script src="/PPW/Ejercicio4xime/resources/js/bootstrap.js"></script>
    <script src="/PPW/Ejercicio4xime/resources/js/bundle.js"></script>
    <script src="/PPW/Ejercicio4xime/resources/js/popper.js"></script>
    <script src="/PPW/Ejercicio4xime/resources/js/jquery.js"></script>
    <script src="/PPW/Ejercicio4xime/resources/js/app.js"></script>
<?php 
    if($script != ''){
        echo '<script src="/PPW/Ejercicio4xime/resources/js/'.$script.'.js"></script>';
    }
    }
    
    function foot(){
?>
</body>
</html>
<?php } 