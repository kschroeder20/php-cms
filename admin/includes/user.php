<?php 

class User extends Db_object {

  protected static $db_table = "users";
  protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;


  public static function verify_user($username, $password) {

    global $database;

    $username = $database->escape_string($username);
    $password = $database->escape_string($password);

    $sql = "SELECT * FROM users WHERE ";
    $sql .= "username = '{$username}' AND ";
    $sql .= "password = '{$password}' ";
    $sql .= "LIMIT 1";

    $the_result_array = self::find_by_query($sql);

    return !empty($the_result_array) ? array_shift($the_result_array) : false; 


  }


  public function escape_string($string){

    $escaped_string = mysqli_real_escape_string($this->connection,$string);
    
    return $escape_string;

  }


} // End of User class

?>