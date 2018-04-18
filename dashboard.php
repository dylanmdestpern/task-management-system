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
            <?php if ( isset($_SESSION['teamID']) ) {
        
            devMsg($loggedUserTeamInfo);
    
            ?>
            
                
            
                <h1><?=$loggedUserTeamInfo['teamName']?></h1>
            
                <div class="row">
                    <div class="col-sm">

                    </div>
                    <div class="col-sm">

                    </div>
                </div>
            
            <?php    
            } else {
                include "includes/teamSelection.php";
            }
            ?>
            
        </div>
        
	</body>

</html>
