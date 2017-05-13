
<?php

// SINGLETON DESIGN PATTERN
class Database {

  private static $connection = null;

  // prevents the class from being instantiated
  private function __construct() {}

    static function connect() {

    if(empty($connection)) {

      try {
        $connection = new PDO("mysql:host=localhost;dbname=database name here","username here","password here");
        $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo $e->getMessage();
      }
      return $connection;
    }

  }

     static function disconnect() {
      $connection = null;
    }

}

?>
