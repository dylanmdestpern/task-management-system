<nav class="navbar navbar-expand-lg navbar navbar-light fixed-top" style="background: #FFF; border: 1px solid #CCC">

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
            <span class="navbar-text"><?=randomArrayVar($greeting)?>, <b><?=$loggedUser['first_name']?>!</b>&nbsp;</span>
            <li class="nav-item"> <a class="nav-link" href="#">My account</a></li>
            <li class="nav-item"> <a class="nav-link" href="?action=logout">Logout</a></li>
        </ul>
    </div>
</nav>
