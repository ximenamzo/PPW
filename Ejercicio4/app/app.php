<?php 

    namespace app;

    require_once "autoloader.php";
    use Controllers\auth\LoginController as LoginController;
    use Controllers\PostController as PostController;
    use Controllers\CommentController as CommentController;

    if(!empty($_POST)){
        // L O G I N
        $login = in_array('_login', array_keys(filter_input_array(INPUT_POST)));
        if($login){
            $datos = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $userLogin = new LoginController();
            print_r($userLogin->userAuth($datos));
        }

        // R E G I S T E R
        $register = in_array('_register', array_keys(filter_input_array(INPUT_POST)));
        if($register){
            $datos = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $userRegister = new LoginController();
            print_r($userRegister->userRegister($datos));
        }

        // G U A R D A R   N U E V A   P U B L I C A C I O N
        $gp = in_array('_gp', array_keys(filter_input_array(INPUT_POST)));
        if($gp){
            $datos = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post = new PostController();
            $post->newPost($datos);
            header('Location: /PPW/Ejercicio4/resources/views/autores/newPost.php');
        }


        // E D I T A R   P U B L I C A C I O N
        $ep = in_array('_ep', array_keys(filter_input_array(INPUT_POST)));
        if($ep){
            $datos = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            print_r($datos);
            $post = new PostController();
            $post->editPost($datos);
            header('Location: /PPW/Ejercicio4/resources/views/autores/myposts.php');
        }

        
        // Guardar  c o m e n t a r i o s
        $sc = in_array('_sc', array_keys(filter_input_array(INPUT_POST)));
        if($sc){
            $datos = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post = new PostController();
            print_r($post->saveComment($datos));
        }
    }

    if(!empty($_GET)){
        // L O G O U T
        $logout = in_array('_logout', array_keys(filter_input_array(INPUT_GET)));
        if($logout){
            $userLogout = new LoginController();
            $userLogout->logout();
            header('Location: /PPW/Ejercicio4/resources/views/home.php');
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
            $pid = filter_input_array(INPUT_GET)["pid"];
            $openpost = new PostController();
            print_r($openpost->getPost(1, $pid));
        }

        // Cargar mis publicaciones
        $mp = in_array('_mp', array_keys(filter_input_array(INPUT_GET)));
        if($mp){
            $uid = filter_input_array(INPUT_GET)["uid"];
            $post = new PostController();
            print_r($post->getMyPosts($uid));
        }

        // Checar comentarios
        $cc = in_array('_cc', array_keys(filter_input_array(INPUT_GET)));
        if($cc){
            $c = filter_input_array(INPUT_GET)["pid"];
            $checkcom = new CommentController();
            print_r($checkcom->checkComments(1, $c));
        }

        // Desactivar publicacion
        $tpa = in_array('_tpa', array_keys(filter_input_array(INPUT_GET)));
        if($tpa){
            $pid = filter_input_array(INPUT_GET)["pid"];
            $post = new PostController();
            print_r(json_encode(['r' => $post->togglePostActive($pid)]));
        }

        // Borrar publicaciones
        $dp = in_array('_dp', array_keys(filter_input_array(INPUT_GET)));
        if($dp){
            $d = filter_input_array(INPUT_GET)["pid"];
            $deletepost = new PostController();
            print_r($deletepost->deletePost(1, $d));
        }

        // Recuperar comentarios de una publicacion
        $pm = in_array('_pm', array_keys(filter_input_array(INPUT_GET)));
        if($pm){
            $pid = filter_input_array(INPUT_GET)["pid"];
            $post = new PostController();
            print_r($post->getPostComments($pid));
        }

        // I N T E R A C C I O N E S
        
        // Like o no like
        $tl = in_array('_tl', array_keys(filter_input_array(INPUT_GET)));
        if($tl){
            $datos = filter_input_array(INPUT_GET);
            $post = new PostController();
            print_r($post->toggleLike($datos['uid'],$datos['pid']));
        }

        // Dislike o no dislike
        $td = in_array('_td', array_keys(filter_input_array(INPUT_GET)));
        if($td){
            $datos = filter_input_array(INPUT_GET);
            $post = new PostController();
            print_r($post->toggleDislike($datos['uid'],$datos['pid']));
        }
        
        // Haha o no haha
        $th = in_array('_th', array_keys(filter_input_array(INPUT_GET)));
        if($th){
            $datos = filter_input_array(INPUT_GET);
            $post = new PostController();
            print_r($post->toggleHaha($datos['uid'],$datos['pid']));
        }
    }