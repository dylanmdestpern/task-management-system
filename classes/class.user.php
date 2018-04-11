<?php

include "../functions.php";

class User {
  public function __construct() {

  }

  //User registration
  public function addUser( $username, $firstName, $lastName, $email, $dbPass, $userRole = "user" ) {
    //Encrypy password here (Leave this out for now):
    //$dbPassEnc = md5($dbPass);
    $dbPassEnc = $dbPass;

    //Check if username or email is already registered:
    $sql = "SELECT * FROM users WHERE username = ''".mysql_real_escape_string($username)."'' OR email = '".mysql_real_escape_string($email)."'";

    if( ! $checkExisUserR = mysqli_query($linkID, $sql) ) {
      die("Could not register user. Please contact your administrator");
    }

    if ( mysqli_num_rows($checkExisUserR) > 0 ) {
      
    }

  }

}

?>
