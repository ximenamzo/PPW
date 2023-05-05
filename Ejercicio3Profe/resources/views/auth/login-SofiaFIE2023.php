<?php

    namespace views;
    // require "autoloader.php";
    include "../layouts/main.php";
    //use Controllers\auth\LoginController as LoginController;

    head();

?>
<div class="container">
    <div class="card mt-5 w-50 mx-auto">
        <div class="card-body">
            <form action="" id="login-form">
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" 
                            id="username"
                            class="form-control"
                            name="username"
                            placeholder="Nombre de usuario"
                            required>   
                </div>
                <div class="form-group">
                    <label for="passwd">Contraseña</label>
                    <input type="password" 
                            class="form-control" 
                            id="passwd"
                            name="passwd"
                            required>
                </div>
                <div class="d-grid gap-2 my-2">
                    <small class="form-text text-danger d-none">
                        Sus datos de inicio de sesión son incorrecctos
                    </small>
                    <button class="btn btn-primary" type="submit">
                        Iniciar sesión <i class="bi bi-box-arrow-in-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php scripts(); ?>

<script type="text/javascript">
    $(function(){
        const lf = $("#login-form");
        lf.on("submit", function(e){
            e.preventDefault();
            e.stopPropagation();
            const data = new FormData();
            data.append("username")
        })
    })
</script>