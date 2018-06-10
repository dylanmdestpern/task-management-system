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
                    <?php include "includes/loginForm.php"; ?>
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
