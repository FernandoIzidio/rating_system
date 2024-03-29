<?php
/* 
Módulo destinado a metódos de validação, os outros controllers vão ter apenas metódos de acesso para requisições

*/

namespace app\controllers;
use app\database\config\Connection;
use app\models\UserModel;
use Jenssegers\Blade\Blade;



abstract class BaseController {
    protected static $blade;

    protected function hasSession():bool{
        return (isset($_SESSION) && array_key_exists("logged_in", $_SESSION) && $_SESSION["logged_in"]);
    }
    

    protected function getLogs(): array{
        $json_path = "./logs/logerrors.json";
        $json_desc  = fopen($json_path, "r");

        if (filesize($json_path) > 0){
            $json_content = json_decode(fread($json_desc, filesize($json_path)), true);
        }
        return $json_content;
    }


    protected function getBlade():Blade{
        if (!isset(self::$blade)){
        self::$blade = new Blade("../app/views", "../app/cache");
        }
        return self::$blade;
    }

    protected function hasAdmin():bool{
        return (isset($_SESSION) && array_key_exists("admin_permission", $_SESSION) && ($_SESSION["admin_permission"] || $_SESSION["super_admin"]));
        
    }

    public function hasUser(string $user):bool{

        $pdo = Connection::getConnection();

        $r1 = new UserModel($pdo);

        $users = $r1->getUser(trim($user));


        return count($users) > 0;

    }

    protected abstract function getView();

}

abstract class BaseRegister extends BaseController{
 


    public function validName(string $name){
        if ((strlen(trim($name)) < 3)){
            header("Location: /register?nameError");
            exit();
        }
    }

    public function validLengthUser(string $user){
        if (strlen(trim($user)) < 6){
            header("Location: /register?userError");
            exit();
        }
    }


    public function validLenghtPasswords(string $password, string $index = '1'){
        if (strlen(trim($password) < 8)){
            header("Location: /register?password{$index}Error");
            exit();
        }
    }


    public function validMatchPasswords(string $password1, string $password2){
        if (trim($password1) !== trim($password2)){
            header("Location: /register?passwdUnMatchError");    
            exit();    
        }
    }


    public function validStrongPasswords(string $password){
        if (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", trim($password)) || 
            !preg_match("/[0-9]/", trim($password)) || 
            !preg_match("/[A-Z]/", trim($password)) || 
            !preg_match("/[a-z]/", trim($password))) {
                header("Location: /register?passwdInvalidError");
                exit();
        }
    }

    protected abstract function postView();

}

abstract class BaseLogin extends BaseController{
  

    public function validUser(){
        $hasUser = $this->hasUser($_POST["user"]);
        
        if (!$hasUser) {
            header("Location: /login?loginError");
            exit();
        }
    }

    protected abstract function postView();

}

