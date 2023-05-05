<?php 
    function head(){
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/css/style.css">
    <link rel="stylesheet" href="/resources/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/resources/img/favicon.ico">
    <style>body{font-family:'Roboto',serif;}</style>
    <title>666</title>
</head>
<body>
    <!--<h1 class="rainbow"><b>HOLA MUNDO supongo</b></h1>
    <img src="/resources/img/HKcupcake.gif" alt="demonio">-->

    <div id="app" class="container-fluid p-0">
        <header class="row m-0 bg-light">
            <div class="col-9">
                <h1 class="ml-3 mt-2 rainbow">DIOS NOS ABANDONÓ</h1>
            </div>
            <div class="col-3">                
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
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./inicio.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Información</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menú
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Iniciar sesión</a></li>
                        <li><a class="dropdown-item" href="#">Registrarse</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Configuración</a></li>
                    </ul>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link disabled">xmc 2023 ®</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" id="buscar-palabra" type="search" placeholder="Buscar..." aria-label="Search">
                    <button class="btn btn-outline-success" type="button" onclick="app.buscarPalabra()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg></button>
                </form>
                </div>
            </div>
        </nav>
    </div> 
<?php 
    } 
    function foot(){
?>
    <script src="/resources/js/bootstrap.js"></script>
    <script src="/resources/js/jquery.js"></script>
    <script src="/resources/js/app.js"></script>
</body>
</html>
<?php } 