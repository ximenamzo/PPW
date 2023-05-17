<?php
    namespace views;
    require 'C:\xampp\htdocs\PPW\Ejercicio4xime\app\autoloader.php';
    include "C:/xampp/htdocs/PPW/Ejercicio4xime/resources/views/layouts/main.php";
    use Controllers\auth\LoginController as LoginController;
    $ua = new LoginController;
    head($ua);
?>
<div class="row mx-auto" style="90%">
    <div class="col-4">
        <div id="prev-post" class="list-group mt-2">
            <!--Publicaciones anteriores-->
        </div>
    </div>
    <div class="col-6">
        <div id="content" class="content">
            <!-- Última publicación / Publicación deleccionada -->
            <h2>Usuario logeado</h2>
        </div>
    </div>
    <div class="col">
        <div id="dates" class="list-group">
            <!--Fechas de publicaciones-->
        </div>
    </div>
</div>
<?php scripts(); ?>

<script type="text/javascript">
    $(function(){
        // hacer variables js que se emparejen con las de php para poder enviarlas
        app.previousPost();
        app.lastPost(1);
    });
</script>

<?php
    foot();