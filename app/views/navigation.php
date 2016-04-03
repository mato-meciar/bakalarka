<ul class="sidebar-nav navbar-inverse">
    <?php
        if ($this->isLoggedUser()) {
            echo '<li class="sidebar-brand"><a href="'; echo URL_BASE; echo '/public/home">Tvorba informacnych systemov</a></li>';
            echo '<li><a class="'; echo $this->isNavLinkActive('home') ? 'active' : ''; echo '" href="'; echo URL_BASE; echo '/public/home">Domov</a></li>';
                            if ($this->hasLoggedUserAccess('admin')) {
            echo '<li><a class="'; echo $this->isNavLinkActive('create_project') ? 'active' : ''; echo '" href="'; echo URL_BASE; echo '/public/create_project">Vytvorit projekt</a></li>';
            echo '<li><a href="'; echo URL_BASE; echo '/public/home/logout">Odhlasenie<span class="glyphicon glyphicon-log-out grey"></span></a></li>';
                            } else if ($this->hasLoggedUserAccess('zadavatel')) {
            echo '<li><a class="'; echo $this->isNavLinkActive('create_project') ? 'active' : ''; echo '" href="'; echo URL_BASE; echo '/public/create_project">Vytvorit projekt</a></li>';
            echo '<li><a href="'; echo URL_BASE; echo '/public/home/logout">Odhlasenie<span class="glyphicon glyphicon-log-out grey"></span></a></li>';
                            } else {
            echo '<li><a class="'; echo $this->isNavLinkActive('group_administration') ? 'active' : ''; echo '" href="'; echo URL_BASE; echo '/public/group_administration">Administracia skupiny</a></li>';
            echo '<li><a href="'; echo URL_BASE; echo '/public/home/logout">Odhlasenie<span class="glyphicon glyphicon-log-out grey"></span></a></li>';
                            }
                        } else {
            echo '<li class="sidebar-brand"><a href="'; echo URL_BASE; echo '/public/login">Tvorba informacnych systemov</a></li>';
            echo '<li><a href="'; echo URL_BASE; echo '/public/login">Prihlasenie<span class="glyphicon glyphicon-log-in grey"></span></a></li>';
                }
    ?>
</ul>
