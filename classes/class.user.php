<?php

include_once("functions.php");

class User {
  public function __construct() {

  }

  //User registration
  public function addUser( $linkID, $username, $firstName, $lastName, $email, $confirmEmail, $dbPass, $confirmPass, $userRole = "user" ) {
    //Encrypy password here (Leave this out for now):
    //$dbPassEnc = md5($dbPass);
    $dbPassEnc = $dbPass;

		if ( ! $dbPass === $confirmPass ) {
			die("The passwords you entered do not match.");
		}

		if ( ! $email === $confirmEmail ) {
			die("The emails you entered do not match.");
		}

    //Check if username or email is already registered:
    $sql = "SELECT * FROM users WHERE username = '".mysqli_real_escape_string($linkID, $username)."' OR email = '".mysqli_real_escape_string($linkID, $email)."'";

		//die($sql);

    if( ! $checkExisUserR = mysqli_query($linkID, $sql) ) {
      echo "Could not register user. Please contact your administrator.";
    }

    if ( mysqli_num_rows($checkExisUserR) > 0 ) {
			echo "The username or email you entered is already registered.";
			return false;
    } else {

		}

  }

}

?>
