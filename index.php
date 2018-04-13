<?php
include_once("functions.php");
?>

<!DOCTYPE HTML>
<html>
    
    <p>This is a dev branch</p>
    
	<head>
        <?php include_once("includes/headIncludes.php"); ?>
	</head>

	<body>

        <div class="container">
            
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
        </div>
        
	</body>

</html>
