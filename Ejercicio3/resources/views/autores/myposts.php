<?php
    namespace views;
    require 'C:\xampp\htdocs\PPW\Ejercicio3\app\autoloader.php';
    include "C:/xampp/htdocs/PPW/Ejercicio3/resources/views/layouts/main.php";
    use Controllers\auth\LoginController as LoginController;
    $ua = new LoginController;
    is_null($ua->sessionValidate()) ? header('Location: ./resources/views/auth/login.php') : '';
    head($ua);
?>

<section class="container pt-5">
    <h1 class="border-bottom">Mis publicaciones</h1>
    <form action="/PPW/Ejercicio3/app/app.php" method="POST">
        <div class="card">
            <div class="card-body">
                <table class="table table-stri" ed="">
                    <thead>
                        <th>Titulo</th>
                        <th>Fecha</th>
                        <th><i class="bi bi-gear"></i></th>
                    </thead>
                    <tbody id="my-posts"></tbody>
                </table>
            </div>
            <div class="card-footer">
                
            </div>
        </div>
    </form>
</section>

<?php 
    scripts("app_myposts");
?>
<script>
    $(function(){
        app_myposts.getMyPosts(<?=$ua->id?>);
    });
</script>
<?php 
    foot();