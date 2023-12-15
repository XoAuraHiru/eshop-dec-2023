<?php



class Database{
    public static $connection;

    public static function setUpConnection(){
        if(!isset(Database::$connection)){
            require_once realpath(__DIR__ . '/vendor/autoload.php');
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
            $dotenv->load();
            $db_host = $_ENV["DB_HOST"];
            $db_user = $_ENV["DB_USER"];
            $db_pass = $_ENV["DB_PASS"];
            Database::$connection = new mysqli($db_host, $db_user, $db_pass,"eshop","3306");
        }
    }

    public static function iud($q){
        Database::setUpConnection();
        Database::$connection->query($q);
    }

    public static function search($q){
        Database::setUpConnection();
        $resultset = Database::$connection->query($q);
        return $resultset;
    }
}

?>