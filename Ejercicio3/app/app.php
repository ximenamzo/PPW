<?php 

    namespace app;

    require_once "autoloader.php";
    use Controllers\auth\LoginController as LoginController;
    use Controllers\PostController as PostController;

    if(!empty($_POST)){
        // L O G I N
        $login = in_array('_login', array_keys(filter_input_array(INPUT_POST)));
        if($login){
            $datos = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $userLogin = new LoginController();
            print_r($userLogin->userAuth($datos));
        }

        // G U A R D A R   N U E V A   P U B L I C A C I O N
        $gp = in_array('_gp', array_keys(filter_input_array(INPUT_POST)));
        if($gp){
            $datos = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post = new PostController();
            $post->newPost($datos);
            header('Location: /PPW/Ejercicio/resources/views/autores/newPost.php');
        }
    }

    if(!empty($_GET)){
        // L O G O U T
        $logout = in_array('_logout', array_keys(filter_input_array(INPUT_GET)));
        if($logout){
            $userLogout = new LoginController();
            $userLogout->logout();
            header('Location: /PPW/Ejercicio3/resources/views/home.php');
        }

        // Cargar Publicaciones Previas
        $pp = in_array('_pp', array_keys(filter_input_array(INPUT_GET)));
        if($pp){
            $post = new PostController();
            print_r($post->getPost());
        }

        // Cargar Ultima Publicacion
        $lp = in_array('_lp', array_keys(filter_input_array(INPUT_GET)));
        if($lp){
            $l = filter_input_array(INPUT_GET)["limit"];
            $lastpost = new PostController();
            print_r($lastpost->getPost($l));
        }

        // Abrir publicacion
        $op = in_array('_op', array_keys(filter_input_array(INPUT_GET)));
        if($op){
            $o = filter_input_array(INPUT_GET)["pid"];
            $openpost = new PostController();
            print_r($openpost->getPost(1, $o));
        }

        // Cargar mis publicaciones
        $mp = in_array('_mp', array_keys(filter_input_array(INPUT_GET)));
        if($mp){
            $uid = filter_input_array(INPUT_GET)["uid"];
            $post = new PostController();
            print_r($post->getMyPosts($uid));
        }
    }