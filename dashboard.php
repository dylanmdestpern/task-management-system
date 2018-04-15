<?php $loggedUsersOnly = true; $restrictedRedirectUrl = "index.php?You were redirected from the dashboard because you're not logged in...";?>
<?php include_once("functions.php"); ?>

<!DOCTYPE HTML>
<html>
    
	<head>
        <?php include_once("includes/headIncludes.php"); ?>
	</head>

	<body>

        <?php include_once("includes/dashboardNav.php") ?>
        
        <div class="container">            
            <h1>Dashboard</h1>
            <div class="row">
                <div class="col-sm">
                    
                </div>
                <div class="col-sm">
                    
                </div>
            </div>
            
            <a href="?action=logout">Logout</a>
            
        </div>
        
	</body>

</html>
