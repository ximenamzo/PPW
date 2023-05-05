<?php

    namespace Controllers;

    use Models\posts;
    use Controllers\auth\LoginController as LoginController;

    class PostController {

        private $userId;
        private $title;
        private $body;

        public function __construct(){
            $ua = new LoginController();
            $ua->sessionValidayte();
            $this->userId = $ua->id;
        }

        public function getPosts($pid = ""){
            
        }

    }