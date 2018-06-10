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
        
            devMsg($loggedUserTeaminfo);
    
            ?>
                <?php
                
                if (isset($_GET["section"])) {
                    
                    switch ( $_GET["section"] ) {
                        case "home":
                            echo "Home";
                        break;
                        case "projects":
                            switch ( $_GET["subSection"] ) {
                                case "showAll":
                                    ?>
                                    <h2>All projects</h2>
                                    <?php
                                    
                                    
                                    
                                break;
                                case "editProject":
                                    
                                break;
                                default:
                                    
                                break;
                            }
                        break;
                        default:
                            echo "default";
                        break;
                    }
                } else {
                    
                }
                
                ?>
            
            <?php    
            } else {
                include "includes/teamSelection.php";
            }
            ?>
            
        </div>
        
	</body>

</html>
