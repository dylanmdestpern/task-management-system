<?php
    
    include_once("config.php");
    include_once("classes/class.user.php");

    //MySQL connection.
    $linkID = mySQLConnect();
    function mySQLConnect( $dbserver = DB_SERVER, $dbName = DB_DATABASE, $dbUser = DB_USER, $dbPass = DB_PASSWORD ) {
        if ( ! $con = mysqli_connect($dbserver, $dbUser, $dbPass, $dbName) ) {
            die("Could not connect to database. Please contact your administrator.");
        } else {
            return $con;
        }
    }

	//Request functions here:
	if ( isset($_REQUEST['action']) ) {
        switch ( $_REQUEST['action'] ) {
            case "registerUser":
				echo "<pre>";
				print_r($_REQUEST);
                echo "</pre>";

                $user = new User();
                //$username, $firstName, $lastName, $email, $confirmEmail, $dbPass, $confirmPass, $userRole = "user"
                $user->addUser($linkID, $_REQUEST['username'], $_REQUEST['firstName'], $_REQUEST['lastName'], $_REQUEST['email'], $_REQUEST['confirmEmail'], $_REQUEST['password'], $_REQUEST['confirmPassword']);

            break;
        }
    }

    //Additional functions here:

?>