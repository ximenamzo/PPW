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
    <link rel="stylesheet" href="/PPW/Ejercicio4/resources/css/style.css">
    <link rel="stylesheet" href="/PPW/Ejercicio4/resources/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/PPW/Ejercicio4/resources/img/favicon.ico">
    <style>
        body{
            color:#555;
            background-image: url('/PPW/Ejercicio4/resources/img/bg3.jpg');
        }
        .cabecera {
            background-color:#E4007F;
        }
        .navegacion {
            background: #f3c8df;
            /*background: linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(0,0,0,1) 100%);*/
        }
    </style>
    <title>Blog</title>
</head>
<body>
    <div id="app" class="container-fluid p-0">
        <header class="row m-0 cabecera"> <!-- bg-dark bg-gradient" data-bs-theme="dark"-->
            <div class="col-9">
                <h1 class="ml-3 mt-2 ani">Blog emo punketo rockerito</h1>
            </div>
        </header>
        <nav class="navbar navbar-expand-lg navegacion">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Bienvenid@</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php if(!is_null($ua) && $ua->sv && $ua->tipo == 1){ ?>
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
                                <!--<li><a class="dropdown-item" href="/PPW/Ejercicio4/resources/views/auth/login.php">Iniciar sesión</a></li>
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
    <script src="/PPW/Ejercicio4/resources/js/bootstrap.js"></script>
    <script src="/PPW/Ejercicio4/resources/js/bundle.js"></script>
    <script src="/PPW/Ejercicio4/resources/js/popper.js"></script>
    <script src="/PPW/Ejercicio4/resources/js/jquery.js"></script>
    <script src="/PPW/Ejercicio4/resources/js/app.js"></script>
<?php 
    if($script != ''){
        echo '<script src="/PPW/Ejercicio4/resources/js/'.$script.'.js"></script>';
    }
    }
    
    function foot(){
?>
</body>
</html>
<?php } 