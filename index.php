

<!DOCTYPE HTML>
<html>
    
	<head>
        <?php include_once("includes/headIncludes.php"); ?>
	</head>

	<body>

        <div class="container">
            
            <?php include_once("functions.php"); ?>
            
            <div class="row">
                <div class="col-sm">
                    <!-- Show login form -->
                    <?php include "includes/loginForm.php"; ?>
                </div>
                <div class="col-sm">
                    <!-- Show registration form -->
                    <?php include "includes/registerForm.php"; ?>
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
        
	</body>

</html>
