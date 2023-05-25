<?php
    namespace views;
    require 'C:\xampp\htdocs\PPW\Ejercicio4\app\autoloader.php';
    include "C:/xampp/htdocs/PPW/Ejercicio4/resources/views/layouts/main.php";
    use Controllers\auth\LoginController as LoginController;
    $ua = new LoginController;
    is_null($ua->sessionValidate()) ? header('Location: ./resources/views/auth/login.php') : '';
    head($ua);
?>

<section class="container py-3">
    <h1 class="border-bottom">Nueva Publicación</h1>
    <form action="/PPW/Ejercicio4/app/app.php" method="POST">
        <div class="card">
            <div class="card-body">
                <input type="hidden" name="pid" value="null">
                <input type="hidden" name="uid" value="<?=$ua->id?>">
                <input type="hidden" name="_gp" value="true">
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title" class="form-control"
                        placeholder="Título de la publicación" required>
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Texto</label>
                    <textarea name="body" id="body" cols="80" rows="10" class="form-control"
                        placeholder="Escribe aquí tu próxima funa..." required></textarea>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary float-end" type="submit">Publicar 
                    <i class="bi bi-check-lg"></i>
                </button>
            </div>
        </div>
    </form>
</section>

<?php 
    scripts();
    foot();