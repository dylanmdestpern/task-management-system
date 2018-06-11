<?php $loggedUsersOnly = false; $restrictedRedirectUrl = "";  $loggedInRedirectUrl = "dashboard.php" ?>
<?php include_once("functions.php"); ?>

<!DOCTYPE HTML>
<html>

	<head>
        <?php include_once("includes/headIncludes.php"); ?>
	</head>

	<body style="padding-bottom: 100px;">

        <div class="container">

            <div class="row">
                <div class="col-sm">
                    <!-- Show login form -->
					<?php
						if ( ! isset($_REQUEST['userAction']) ) {
							include "includes/loginForm.php";
						} else {
							switch ( $_REQUEST['userAction'] ) {
								case 'register':
									include "includes/registerForm.php";
									break;
								case "login":
									include "includes/loginForm.php";
									break;
								default:
									include "includes/loginForm.php";
									break;
							}
						}
					?>
                </div>
            </div>

            <?php
            if ( isset($_SESSION['userLoggedIn']) && $_SESSION['userLoggedIn'] == true ) {
                ?>
                <a href="index.php?action=logout">Logout</a>
                <?php
            }
            ?>

        </div>

        <div class="footer-bottom">
            Copyright &copy; 2018 by <a href="http://www.go4software.co.za" target="_blank">Go4 Software</a>
        </div>

	</body>

</html>
