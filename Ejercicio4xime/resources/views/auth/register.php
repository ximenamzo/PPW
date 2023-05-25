<?php
    namespace views;
    require '../../../app/autoloader.php'; //import en java
    include "../layouts/main.php"; //import en java
    use Controllers\auth\LoginController as LoginController;
    head();
?>
<div class="container">
    <div class="card mt-3 w-50 mx-auto mb-5">
        <div class="card-body">
            <form action="" id="register-form">
                <div class="form-group mt-2">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" class="form-control" name="name" placeholder="Nombre completo" required>
                </div>
                <div class="form-group mt-2">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" class="form-control" name="email" placeholder="ej.: user@mail.com" required>
                </div>
                <div class="form-group mt-2">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" class="form-control" name="username" placeholder="Nombre de Usuario" required>
                </div>
                <div class="form-group mt-2">
                    <label for="passwd">Contraseña</label>
                    <input type="password" class="form-control" id="passwd" name="passwd" required>
                </div>
                <div class="form-group mt-2">
                    <label for="passwd2">Confirmar contraseña</label>
                    <input type="password" class="form-control" id="passwd2" name="passwd2" required>
                </div>
                <div class="d-grid gap-2 my-3">
                    <small class="form-text text-danger d-none mb-2" id="error">
                        Sus datos de registro son incorrectos.
                    </small>
                    <button class="btn btn-primary" type="submit">
                        Registrarse <i class="bi bi-emoji-smile"></i>
                    </button>
                    <button class="btn btn-link float-end" type="button" onclick="app.view('inisession');">
                        Si ya tienes una cuenta, ingresa ¡aquí!
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php scripts();?>

<script type="text/javascript">
    $(function(){
        const rf = $("#register-form");
        rf.on("submit", function(e){
            e.preventDefault();
            e.stopPropagation();
            const data = new FormData();
            data.append("name",$("#name").val());
            data.append("email",$("#email").val());
            data.append("username",$("#username").val());
            data.append("passwd",$("#passwd").val());
            if($("#passwd").val() === $("#passwd2").val()){
                data.append("_register","");
                fetch(app.routes.doregister,{
                    method : "POST",
                    body : data
                })
                    .then ( resp => resp.json())
                    .then ( resp => {
                        if(resp.r !== false){
                            //location.href = "login.php";
                            app.view("inisession");
                        }else{
                            $("#error").removeClass("d-none");
                        }
                    }).catch( err => console.error( err ));
            } else {
                alert("Las contraseñas no coinciden.")
            }
        })
    })
</script>

