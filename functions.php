<?php

session_start();

if ( isset($_REQUEST['displaySuccessMsg']) ) {
    echo success($_REQUEST['displaySuccessMsg']);
}

if ( isset($_REQUEST['displayErrorMsg']) ) {
    echo error($_REQUEST['displayErrorMsg']);
}

if ( isset($_REQUEST['displayMsg']) ) {
    echo primary($_REQUEST['displayMsg']);
}
?>

<?php
    
    include_once("config.php");
    include_once("classes/class.user.php");

    if ( DEBUG_MODE ) {
        ?>
        <div class='alert alert-small alert-warning fade show' role='alert'>
            This is a dev branch
        </div>
    <?php
    }

    //MySQL connection.
    $linkID = mySQLConnect();
    function mySQLConnect( $dbserver = DB_SERVER, $dbName = DB_DATABASE, $dbUser = DB_USER, $dbPass = DB_PASSWORD ) {
        if ( ! $con = mysqli_connect($dbserver, $dbUser, $dbPass, $dbName) ) {
            die("Could not connect to database. Please contact your administrator.");
        } else {
            return $con;
        }
    }

    if ( isset($_SESSION['userLoggedIn']) ) {
        if ($_SESSION['userLoggedIn'] == true) {
            $loggedUser = new User($linkID, $_SESSION['userId']);
            devMsg($loggedUser->getUserInfo());
        }
    } else {
        echo "Not logged in";
    }

	//Action functions here:
	if ( isset($_REQUEST['action']) ) {
        switch ( $_REQUEST['action'] ) {
            case "registerUser":
                $user = new User();
                //$username, $firstName, $lastName, $email, $confirmEmail, $dbPass, $confirmPass, $userRole = "user"
                if ( ! $user->addUser($linkID, $_REQUEST['username'], $_REQUEST['firstName'], $_REQUEST['lastName'], $_REQUEST['email'], $_REQUEST['confirmEmail'], $_REQUEST['password'], $_REQUEST['confirmPassword']) ) {
                    echo error($user->getErrorMsg());
                    
                    if ( DEBUG_MODE == true && $user->getDebugErrorMsg() != "" ) {
                        echo debug($user->getDebugErrorMsg());
                    }
                    
                } else {
                    header("Location: index.php?displaySuccessMsg=User registered successfully!&displayMsg=Your account is awaiting approval from an admin. You will receive an email at <b>".$_REQUEST['email']."</b> once it's activated.");
                }
                
            break;
            case "loginUser":
                $user = new User();
                
                if ( ! $user->login($linkID, $_REQUEST['usernameEmail'], $_REQUEST['password'] )) {
                    echo error($user->getErrorMsg());
                    
                    if ( DEBUG_MODE == true && $user->getDebugErrorMsg() != "" ) {
                        echo debug($user->getDebugErrorMsg());
                    }
                    
                } else {
                    //Login successful
                    header("Location: index.php");
                }
                
            break;
            case "logout":
                $user = new User();
                $user->userLogout();
                header("Location: index.php?displayMsg=Successfully logged out.");
            break;
        }
    }

    //Additional functions here:

    //Messages
    function error ( $errorMsg ) {
        $errorText = "<div class='alert alert-small alert-danger alert-dismissible fade show' role='alert'>".$errorMsg;
        $errorText .= "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        return $errorText;
    }

    function success ( $successMsg ) {
        $successText = "<div class='alert alert-small alert-success alert-dismissible fade show' role='alert'>".$successMsg;
        $successText .= "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        return $successText;
    }

    function primary ( $primaryMsg ) {
        $primaryText = "<div class='alert alert-small alert-primary alert-dismissible fade show' role='alert'>".$primaryMsg;
        $primaryText .= "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        return $primaryText;
    }

    function debug ( $debugMsg ) {
        $debugText = "<div class='alert alert-small alert-warning alert-dismissible fade show' role='alert'><b>Debug message:</b><br /><hr />".$debugMsg;
        $debugText .= "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        return $debugText;
    }

    function devMsg ( $devMsg ) {
        echo "<pre>";
        print_r($devMsg);
        echo "</pre>";
    }

?>