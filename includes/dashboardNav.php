<nav class="navbar navbar-expand-lg navbar navbar-light fixed-top" style="background: #FFF; border: 1px solid #CCC"> <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active"> <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <span class="navbar-text"><?=randomArrayVar($greeting)?>, <b><?=$loggedUser['first_name']?>!</b>&nbsp;</span>
            <li class="nav-item"> <a class="nav-link" href="#">My account</a></li>
            <li class="nav-item"> <a class="nav-link" href="?action=logout">Logout</a></li>
        </ul>
    </div>
</nav>