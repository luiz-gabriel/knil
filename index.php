<?php
/* Informa o nível dos erros que serão exibidos */
error_reporting(E_ALL);

/* Habilita a exibição de erros */
ini_set("display_errors", 1);

class App{
private static $pdo;
private static $sql;

function __construct(){
  App::execute();
}

public static function execute(){
  $url = isset($_GET['url']) ? explode('/',$_GET['url'])[0] : 'Home';
  $small_link = $url[0];
  if($url != 'Home'){
    require('Db/DataBase.php');
    self::$pdo = DataBase::getInstance();

    self::$sql = self::$pdo->prepare("SELECT `link`, `small_link` FROM `links` WHERE $small_link");
    self::$sql->execute();
    $return = self::$sql->fetch();

    if ($return[1] = $small_link)
    {
      $click = App::clickRegister($return["small_link"]);
      if ($click === true) {
        header("Location: http://$return[0]");
        die();
      }else{
        die('erro');
      }

    }else{
      echo "string";
      die();
    }

  }
}

public static function clickRegister($link){
  $link = $link;
  self::$sql = self::$pdo->prepare("INSERT INTO `clicks` (click) VALUES (?)");
  self::$sql->execute(array($link));

  $response = self::$sql == true ? true : false;
  return $response;
}

}

new App;
