<?php

    namespace Controllers\auth; //package
    use Models\user;

    class LoginController{

        public $sv; //Sesion validada
        public $name;
        public $id;
        public $tipo;

        public function __construct(){
            $this->sv = false;
        }

        // Registro de usuario
        public function userRegister($datos){
            $user = new user();
            $user->valores = [$datos['name'], 
                              $datos['username'], 
                              $datos['email'], 
                              sha1($datos['passwd'])];
            $result = $user->create();
            return $result;
            die;
        }

        // Autenticacion de usuario
        public function userAuth($datos){
            $user = new user();
            $result = $user->where([["username",$datos["username"]],
                                    ["passwd",sha1($datos["passwd"])]])->get();
            if(count(json_decode($result)) > 0){
                //Se registra la sesion
                return $this->sessionRegister($result); //enviamos el resultado de la db, no los datos de la pag
                //return algo
            } else {
                $this->sessionDestroy();
                echo json_encode(["r" => false]); //sesionDestroy devuelve false
            }
        }

        // Registro de sesion
        private function sessionRegister($r){
            //print_r(json_decode($datos)); //para ver en consola
            
            //die;
            session_start();
            $datos = json_decode($r);
            $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['username'] = $datos[0]->username; // seleccionamos el atributo
            $_SESSION['passwd'] = $datos[0]->passwd;
            $_SESSION['tipo'] = $datos[0]->tipo;
            session_write_close();
            return json_encode(["r" => true]);

            //Esto no deja acceder
            //$_SESSION['username'] = $datos['username'];
            //$_SESSION['passwd'] = sha1($datos['passwd']);
            //$_SESSION['tipo'] = $datos['tipo'];
        }

        // Validacion de sesion 
        public function sessionValidate(){
            $user = new user();
            session_start();
            if(session_status() == PHP_SESSION_ACTIVE && count($_SESSION) > 0){
                $datos = $_SESSION;
                $result = $user->where([["username",$datos["username"]],
                                        ["passwd",$datos["passwd"]]])->get(); //libreria base de datos
                if(count(json_decode($result)) > 0 && $datos['IP'] == $_SERVER['REMOTE_ADDR']){
                    session_write_close();
                    $this->sv = true;
                    //Combiene el decode del sessionRegister
                    $this->name = json_decode($result)[0]->name;
                    $this->id = json_decode($result)[0]->id;
                    $this->tipo = json_decode($result)[0]->tipo;
                    return $result;
                }
            } else {
                session_write_close();
                $this->sessionDestroy();
                return null;
            }
        }

        // Destruye sesion
        private function sessionDestroy(){
            session_start();
            $_SESSION = [];
            session_destroy();
            session_write_close();
            $this->sv = false;
            $this->name = "";
            $this->id = "";
            $this->tipo = "";
            return;
        }

        // Salir de la sesion
        public function logout(){
            $this->sessionDestroy();
            return;
        }
    }
