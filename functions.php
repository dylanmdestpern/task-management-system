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

    //If config.php does not exist. Display a debug message to indicate.
	if ( ! file_exists("config.php") ) {
		die(error("No config.php file was found. Create a config file or copy one from repo."));
	}

	include_once("config.php");
    include_once("classes/class.user.php");
    include_once("classes/class.team.php");

	if ( DEBUG_MODE ) {
		echo primary("This is a developement environment with <b>debugging</b> enabled.");
	}

    //MySQL connection.
    $linkID = mySQLConnect();
    function mySQLConnect( $dbserver = DB_SERVER, $dbName = DB_DATABASE, $dbUser = DB_USER, $dbPass = DB_PASSWORD ) {
        if ( ! $con = mysqli_connect($dbserver, $dbUser, $dbPass, $dbName) ) {
            die("Could not cosnnect to database. Please contact your administrator.");
        } else {
            return $con;
        }
    }

    if ( isset($_SESSION['userLoggedIn']) ) {

        if ( isset($loggedInRedirectUrl) ) {
            header("Location: ".$loggedInRedirectUrl);
        }

        if ($_SESSION['userLoggedIn'] == true) {
            $loggedUserArray = new User($linkID, $_SESSION['userId']);
            $loggedUser = $loggedUserArray->getUserInfo();

            if ( $loggedUser['active'] == 0 ) {
                $loggedUserArray->userLogout();
                header('Location: index.php?displayErrorMsg=Your account is still awaiting admin approval. Please contact your administrator.');
            }

            $userIsAdmin = false;

            if ( $loggedUser['user_role'] == "admin") {
                $userIsAdmin = true;
            }

            //Now that we know the user is logged in with no objections, we can retrieve all extra info for the user
            $loggedUserTeamsIdsArray = new Team();
            $loggedUserTeamsIds = $loggedUserTeamsIdsArray->getUserTeamIds($linkID, $loggedUser['id']);

            if ( isset($_SESSION['teamID']) ) {
                //Get team info
                $loggedUserTeaminfo = $loggedUserTeamsIdsArray->getTeamInfo($linkID, $_SESSION['teamID']);
				$loggedUserTeamRole = $loggedUserTeamsIdsArray->getUserTeamRole($linkID, $_SESSION['teamID'], $loggedUser['id']);
            }

            //devMsg($loggedUserTeamsIds);
            //devMsg($loggedUserArray ->getUserInfo());
        }

    } else {
        if ( isset($loggedUsersOnly) && isset($restrictedRedirectUrl) ) {
            if ( $loggedUsersOnly == true ) {
                header("Location: index.php?displayMsg=You were redirected here because you're not logged in.");
            }
        }
    }

	//Action functions here:
	if ( isset($_REQUEST['action']) ) {
        switch ( $_REQUEST['action'] ) {
            case "registerUser":
                $user = new User();
                //$username, $firstName, $lastName, $email, $confirmEmail, $dbPass, $confirmPass, $userRole = "user"
                if ( ! $user->addUser(
				$linkID, $_REQUEST['username'],
				$_REQUEST['firstName'],
				$_REQUEST['lastName'],
				$_REQUEST['email'],
				$_REQUEST['confirmEmail'],
				$_REQUEST['password'],
				$_REQUEST['confirmPassword']) ) {

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
            case "setSessionTeamID":
                if ( $_SESSION['userLoggedIn'] == true && isset($loggedUser) && $_REQUEST['teamID']) {

                    if ( in_array($_REQUEST['teamID'], $loggedUserTeamsIds) ) {
                        $_SESSION['teamID'] = $_REQUEST['teamID'];
                    } else {
                        $_SESSION['teamID'] = null;
                    }

                    header("Location: index.php");

                } else {
                    header("Location: index.php");
                }
            break;
        }
    }

    //Additional functions here:
    //random array function you can use or write your own
    function randomArrayVar ($array) {
        if (!is_array($array)) {
            return $array;
        }
        return $array[array_rand($array)];
    }

    //list of grettings as arary
    $greeting= array(
        "aloha"=>"Aloha",
        "ahoy"=>"Ahoy",
        "bonjour"=>"Bonjour",
        "gday"=>"G'day",
        "hello"=>"Hello",
        "hey"=>"Hey",
        "hi"=>"Hi",
        "hola"=>"Hola",
        "howdy"=>"Howdy",
        "salutations"=>"Salutations",
        "sup"=>"Sup",
        "whatsup"=>"What's up",
        "yo"=>"Yo",
        "howzit"=>"Howzit"
    );

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
