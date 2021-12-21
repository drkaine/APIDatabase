<?php

class Autoloader
{

    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class){
        if(is_file('models/' . $class . '.php')){
            require_once 'models/' . $class . '.php';
        }
        if(is_file('controller/' . $class . '.php')){
            require_once 'Controller/' . $class . '.php';
        }
    }

}