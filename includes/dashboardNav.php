<?php

$notifications = new notification;

$notifCount = $notifications->getUserUnreadNotificationCount ( $linkID, $loggedUser['id'] );

$userNotifications = $notifications->getUserNotifications($linkID, $loggedUser['id'], 1);
if ( $userNotifications == false ) {
	if ( DEBUG_MODE ) {
		echo debug($notifications->getDebugErrorMsg());
	}
	echo error($notifications->getErrorMsg());
}

?>

<nav class="navbar navbar-expand-lg navbar navbar-light fixed-top" style="background: #FFF; border: 1px solid #CCC; padding: 0px 5px;">

    <a class="navbar-brand" href="#">Dashboard<?php if ( isset($loggedUserteaminfo) ) { echo " - ".$loggedUserteaminfo['teamName']; } ?></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active"> <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Tools</a>
                <div class="dropdown-menu">

                    <!-- ADMIN ONLY -->
                    <?php if ( $userIsAdmin ) { ?>
                        <span class="dropdown-header">Admin tools</span>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <span class="dropdown-header">General tools</span>
                        <div class="dropdown-divider"></div>
                    <?php } ?>
                    <!-- END ADMIN ONLY -->


                    <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
			<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" data-offset="100,200">Notifications (<?=$notifCount?>)</a>
                <div class="dropdown-menu dropdown-menu-right notifications-div">
					<ul class="notifications-container">
						<?php
						if ( $notifCount == 0 ) {
							?>
							<li style="padding: 5px 5px; border-bottom:1px solid rgba(0, 0, 0, 0.15); color: #999">
								No new notifications...
							</li>
							<?php
						} else {
							foreach ( $userNotifications as $userNotification ) {
								?>
								<a href="<?=$userNotification['clickURL']?>">
									<li>
										<table>
											<tr>
												<td colspan="2" class="notification-text"><?=$userNotification['description']?></td>
											</tr>
											<tr>
												<td></td>
												<td class="notification-time"><?=$userNotification['timestamp']?></td>
											</tr>
										</table>
									</li>
								</a>
								<?php
							}
						}
						?>
						<li style="padding: 0px 5px;">
							<table>
								<tr>
									<td style="text-align: right;"><a href="#"><small>Mark all as read</small></a></td>
								</tr>
							</table>
						</li>
					</ul>
                </div>
            </li>

            <span class="navbar-text"><?=randomArrayVar($greeting)?>, <b><?=$loggedUser['first_name']?>!</b>&nbsp;</span>
            <li class="nav-item"> <a class="nav-link" href="#">My account</a></li>
            <li class="nav-item"> <a class="nav-link" href="?action=logout">Logout</a></li>
        </ul>
    </div>
</nav>
