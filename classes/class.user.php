<?php

include_once("functions.php");

class User {

    private $errorMsg = "";
    private $debugErrorMsg = "";
    private $userInfo;
    
    public function __construct( $linkID = null, $userID = null ) {
        if ( !$linkID == null && ! $userID == null ) {
            $this->userInfo = $this->getUserInfoArray($linkID, $userID);
        }
    }

    public function getErrorMsg () {
        return $this->errorMsg;
    }

    public function getDebugErrorMsg () {
        return $this->debugErrorMsg;
    }

    //User registration
    public function addUser( $linkID, $username, $firstName, $lastName, $email, $confirmEmail, $dbPass, $confirmPass, $userRole = "user" ) {
        //Check if email is valid email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errorMsg = "Please enter a valid email address.";
            return false;
        }

		if ( $dbPass != $confirmPass ) {
			$this->errorMsg = "The passwords you entered do not match.";
            return false;
		} else {
            $errors = array();
            $errorDisplay = "";
            $this->checkPassword($dbPass, $errors);

		    if ( count($errors) > 0 ) {
                $errorDisplay .= "<ul>";
                foreach ( $errors as $error ) {
                    $errorDisplay .= "<li>".$error."</li>";
                }
                $errorDisplay .= "</ul>";
                $this->errorMsg = "The password you entered does not meet the requirements: <br />".$errorDisplay;
                return false;
		    } else {
		        //Encrypt password here (Leave this out for now):
                //$dbPassEnc = md5($dbPass);
                $dbPassEnc = password_hash($dbPass, PASSWORD_DEFAULT);
                //To get password:
                //password_verify($dbPass, $hashedPassword);
		    }
		}

		if ( $email != $confirmEmail ) {
            $this->errorMsg = "The emails you entered do not match.";
            return false;
		}

        //Check if username or email is already registered:
        $sql = "SELECT * FROM ".DB_PREFIX."users WHERE username = '".mysqli_real_escape_string($linkID, $username)."' OR email = '".mysqli_real_escape_string($linkID, $email)."'";

        if( ! $checkExistUserR = mysqli_query($linkID, $sql) ) {
            $this->errorMsg = "Could not register user. Please contact your administrator.";
            $this->debugErrorMsg = mysqli_error($linkID);
            return false;
        } else {
            if ( mysqli_num_rows($checkExistUserR) > 0 ) {
                $this->errorMsg = "The username or email you entered is already registered.";
                return false;
            }
        }

        mysqli_query($linkID, "SET autocommit=0");
        mysqli_query($linkID, "BEGIN TRANSACTION");

        //We can now register the user
        $sql = "INSERT INTO ".DB_PREFIX."users VALUES (
            NULL,
            '".mysqli_real_escape_string($linkID, $username)."',
            '".mysqli_real_escape_string($linkID, $email)."',
            '".mysqli_real_escape_string($linkID, $firstName)."',
            '".mysqli_real_escape_string($linkID, $lastName)."',
            '".mysqli_real_escape_string($linkID, 'user')."',
            false
        )";

        if ( ! $insertUserR = mysqli_query($linkID, $sql) ) {
            $this->errorMsg = "A database error occured while registring the new user. Please contact your administrator.";
            $this->debugErrorMsg = mysqli_error($linkID);
            return false;
        } else {
            //Insert user password
            $userInsertID = mysqli_insert_id($linkID);
            $sql = "INSERT INTO ".DB_PREFIX."userpasswords VALUES (
                NULL,
                '".mysqli_real_escape_string($linkID, $dbPassEnc)."',
                ".mysqli_real_escape_string($linkID, $userInsertID)."
            )";

            if ( ! $insertUserPass = mysqli_query($linkID, $sql) ) {
                mysqli_query($linkID, "ROLLBACK");
                $this->errorMsg = "A database error occured. Please contact your administrator.";
                $this->debugErrorMsg = mysqli_error($linkID);
                return false;
            } else {
                mysqli_query($linkID, "COMMIT");
                return true;
            }
        }
    }

    public function login( $linkID, $userNameEmail, $password ) {

        if ( ! strlen($userNameEmail) > 0 ) {
            $this->errorMsg = "Please enter a valid username.";
            return false;
        }

        if ( ! strlen($password) > 0 ) {
            $this->errorMsg = "Please enter a password.";
            return false;
        }

        $sql = "SELECT ".DB_PREFIX."users.*, ".DB_PREFIX."userpasswords.password FROM ".DB_PREFIX."users JOIN ".DB_PREFIX."userpasswords ON ".DB_PREFIX."users.id = ".DB_PREFIX."userpasswords.userId WHERE
            username = '".mysqli_real_escape_string($linkID, $userNameEmail)."'
            OR email = '".mysqli_real_escape_string($linkID, $userNameEmail)."'
        ";

        if ( ! $userInfoR = mysqli_query($linkID, $sql) ) {
            $this->errorMsg = "A database error occured. Please contact your administrator.";
            $this->debugErrorMsg = $sql." - ".mysqli_error($linkID);
            return false;
        }

        if ( mysqli_num_rows($userInfoR) != 1 ) {
            $this->errorMsg = "The username, email or password you entered is incorrect. Please try again.";
            return false;
        }

        $userInfo = mysqli_fetch_assoc($userInfoR);

        //devMsg($userInfo);

        if ( ! password_verify($password, $userInfo['password']) ) {
            $this->errorMsg = "The username, email or password you entered is incorrect. Please try again.";
        } else {
            $_SESSION['userLoggedIn'] = true;
            $_SESSION['userId'] = $userInfo['id'];
            return true;
        }

    }

    public function getUserInfoArray ( $linkID, $userID ) {
        $sql = "SELECT * FROM ".DB_PREFIX."users WHERE id = ".mysqli_real_escape_string($linkID, $userID);
        if ( ! $userInfoR = mysqli_query($linkID, $sql) ) {
            $this->errorMsg = "A database error occured. Could not retrieve user info. Please contact your administrator.";
            $this->debugErrorMsg = mysqli_error($linkID);
            return false;
        }

        if ( mysqli_num_rows($userInfoR) < 1 ) {
            $this->errorMsg = "The user does not exist. Please contact your administrator.";
            return false;
        }

        return mysqli_fetch_assoc($userInfoR);

    }

    public function getUserInfo () {
        return $this->userInfo;
    }

    public function userLogout () {
        $_SESSION['userLoggedIn'] = false;
        session_destroy();
    }

    public function checkPassword($pwd, &$errors) {
        $errors_init = $errors;

        if (strlen($pwd) < 8) {
            $errors[] = "The password must be longer than 8 characters.";
        }

        if (!preg_match("#[0-9]+#", $pwd)) {
            $errors[] = "Password must include at least one number.";
        }

        if (!preg_match("#[a-zA-Z]+#", $pwd)) {
            $errors[] = "Password must include at least one letter.";
        }

        return ($errors == $errors_init);
    }

}

?>
