<?php
//Router.php mode file:
namespace App; // xcomposer in App namespace i altında çalışabilmesi için
class Router{
    private static $moduleName;

    public static function init(){
        self::$moduleName ='defaultPage';
    } 

    public static function getModule(){
        if(isset($_GET["route"])){
            $route= $_GET["route"];
            $routeArray= explode( '/' , $route );
            $moduleName=isset($routeArray[0]) ? htmlspecialchars($routeArray[0]) : self::$moduleName ;
            $moduleTask=isset($routeArray[1]) ? htmlspecialchars($routeArray[1]) : 'defaultModule' ;
            $moduleParam=isset($routeArray[2]) ? htmlspecialchars($routeArray[2]) : null ;

            echo "Module: " . htmlspecialchars($moduleName) . "<br>";
            echo "Task: " . htmlspecialchars($moduleTask) . "<br>";
            echo "Param: " . htmlspecialchars($moduleParam) . "<br>";
           $filePath= "./modules/".$moduleName.".php?task=" . $moduleTask . "&param=" . $moduleParam ;
            require_once $filePath;
        }else{
            echo "Default Route:" . self::$moduleName;
         }
}

}