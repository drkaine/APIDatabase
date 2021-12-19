<?php


/**
 * Class Autoloader
 */
class Autoloader{

    /**
     * Enregistre cet autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à la classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload($class){
        if(is_file('models/' . $class . '.php')){
            require_once 'models/' . $class . '.php';
        }
        if(is_file('controller/' . $class . '.php')){
            require_once 'Controller/' . $class . '.php';
        }
    }

}