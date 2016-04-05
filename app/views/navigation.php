<ul class="sidebar-nav navbar-inverse">
    <?php
        if ($this->isLoggedUser()) {
            echo '<li class="sidebar-brand"><a href="'; echo URL_BASE; echo '/public/home">Tvorba informacnych systemov</a></li>';
            echo '<li><a class="'; echo $this->isNavLinkActive('home') ? 'active' : ''; echo '" href="'; echo URL_BASE; echo '/public/home">Domov</a></li>';
                            if ($this->hasLoggedUserAccess('admin')) {
                        echo '<li class="dropdown '; echo $this->isNavLinkActive('projects') ? 'active' : ''; echo '">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Zoznam projektov
                <span class="caret"></span></a>
                <ul class="dropdown-menu navbar-inverse">
                    <li><a href="'; echo URL_BASE; echo '/public/projects/index/true">Moje</a></li>
                    <li><a href="'; echo URL_BASE; echo '/public/projects">Vsetky</a></li>
                </ul>';
            echo '<li><a class="'; echo $this->isNavLinkActive('create_project') ? 'active' : ''; echo '" href="'; echo URL_BASE; echo '/public/create_project">Vytvorit projekt</a></li>';
            echo '<li><a href="'; echo URL_BASE; echo '/public/home/logout">Odhlasenie<span class="glyphicon glyphicon-log-out grey"></span></a></li>';
                            } else if ($this->hasLoggedUserAccess('zadavatel')) {            
            echo '<li class="dropdown '; echo $this->isNavLinkActive('projects') ? 'active' : ''; echo '">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Zoznam projektov
                <span class="caret"></span></a>
                <ul class="dropdown-menu navbar-inverse">
                    <li><a href="'; echo URL_BASE; echo '/public/projects/index/true">Moje</a></li>
                    <li><a href="'; echo URL_BASE; echo '/public/projects">Vsetky</a></li>
                </ul>';
            echo '<li><a class="'; echo $this->isNavLinkActive('create_project') ? 'active' : ''; echo '" href="'; echo URL_BASE; echo '/public/create_project">Vytvorit projekt</a></li>';
            echo '<li><a href="'; echo URL_BASE; echo '/public/home/logout">Odhlasenie<span class="glyphicon glyphicon-log-out grey"></span></a></li>';
                            } else {
            echo '<li class="dropdown '; echo $this->isNavLinkActive('group') ? 'active' : ''; echo '">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administracia skupiny
                <span class="caret"></span></a>
                <ul class="dropdown-menu navbar-inverse">
                    <li><a href="'; echo URL_BASE; echo '/public/groups/index">Vytvorit</a></li>
                    <li><a href="'; echo URL_BASE; echo '/public/groups/edit">Upravit</a></li>
                </ul>';
            echo '<li><a class="'; echo $this->isNavLinkActive('projects') ? 'active' : ''; echo '" href="'; echo URL_BASE; echo '/public/projects">Zoznam projektov</a></li>';
            echo '<li><a href="'; echo URL_BASE; echo '/public/home/logout">Odhlasenie<span class="glyphicon glyphicon-log-out grey"></span></a></li>';
                            }
                        } else {
            echo '<li class="sidebar-brand"><a href="'; echo URL_BASE; echo '/public/login">Tvorba informacnych systemov</a></li>';
            echo '<li><a href="'; echo URL_BASE; echo '/public/login">Prihlasenie<span class="glyphicon glyphicon-log-in grey"></span></a></li>';
                }
    ?>
</ul>
