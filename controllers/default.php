<?php 
namespace SDFramework\Controllers;
use SDFramework\Controller;
use \SDFramework\Database;
use SDFramework\Environment;
use SDFramework\ExceptionHandler;
class DefaultController
{
   /**
    * welcome
    * Главная страница
    * @return void
    */
   public static function welcome()
   {
    return '
    <head>
    <link type="text/css" rel="stylesheet" href="/style.css">
    </head>
    <body>
        <img src="/logo.svg" alt="logo"/>
    </body>
    ';
   }

   /**
    * col_get_between
    * Выводит данные 
    * @param mixed $id
    * @param mixed $field
    * @return void
    */
    public static function col_get_between($field, $table, $field_sort, $between_up, $between_down, $departament)
    {
       $db = (new Database())->ORM;
       $f = $field;
       if($field == "all") $f = '*';
       if($departament=="0"){
         $data = $db->getAll('SELECT '.$f.' FROM '.$table.' WHERE '.$field_sort.' BETWEEN '.$between_up.' AND '.$between_down.'');
       }
       else{
         $data = $db->getAll('SELECT '.$f.' FROM '.$table.' WHERE ('.$field_sort.' BETWEEN '.$between_up.' AND '.$between_down.') AND departament='.$departament);
       }
       
       return json_encode($data);
    }

   /**
    * col_get_by
    * Выводит данные 
    * @param mixed $id
    * @param mixed $field
    * @return void
    */
   public static function get_method($filed, $table)
   {
      $db = (new Database())->ORM;
      $f = $field;
      if($field == "all"){
        $f = '*';
      } ;
      $data = $db->getAll('SELECT '.$f.' FROM '.$table);
      return json_encode($data);
   }


   /**
    * turn_stat_refactor
    * Рефакторинг таблицы turn_stat в нормальный вид с исправлением типов данных дат
    * @return void
    */


   public static function registration()
   {
      $db = (new Database())->ORM;
      $data = $_POST;

      // Указываем, что будем работать с таблицей users
      $users = $db->dispense('users');
      // Заполняем объект свойствами
      $users->login = $data['login'];
      $users->password = Md5($data['password']);
      $users->user_story = $data['user_story'];
      $users->user_age = $data['user_age'];
      $users->user_experience = $data['user_experience'];
      $users->user_name = $data['user_name'];
      $users->user_sname = $data['user_sname'];
      $users->user_themes = $data['user_themes'];
      $users->visible_name = $data['visible_name'];
      $users->courses = 0;
      $users->root = Md5(1);
      $users->regdate = date('Y-m-d H:i:s');
      $users->friends = $data['friends'];

      // Сохраняем объект
      $db->store($users);

      return json_encode($data);
   }

    public static function enter()
    {
       $db = (new Database())->ORM;

       $data = $db->getAll('SELECT * FROM users');
       return json_encode($data);
    }

}
?>