<div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse" aria-expanded="false">
        <span class="sr-only">Zobrazit menu</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>        
    </button>
    <?php if (User::isLoggedUser()) {
        echo '<a class="navbar-brand" href="'; echo URL_BASE; echo '/public/home">Tvorba informacnych systemov</a>';
    } else {
        echo '<a class="navbar-brand" href="'; echo URL_BASE; echo '/public/login">Tvorba informacnych systemov</a>';
    }
    ?>
</div>
<div class="collapse navbar-collapse" id="main-navbar-collapse">
    <ul class="nav navbar-nav navbar-inverse">
        <?php
        require_once dirname(dirname(__FILE__))."/models/DBtables/Project.php";
        if (User::isLoggedUser()) {
            echo '<li><a class="'; echo $this->isNavLinkActive('home') ? 'active' : ''; echo '" href="'; echo URL_BASE; echo '/public/home">Domov</a></li>';
                            if (User::hasLoggedUserAccess('admin')) {
                        echo '<li class="dropdown">
                <a class="dropdown-toggle  '; echo $this->isNavLinkActive('projects') ? 'active' : ''; echo '" data-toggle="dropdown" href="#">Zoznam projektov
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="'; echo URL_BASE; echo '/public/projects/approval">Na schvalenie <span class="badge">'; $project = new Project(); echo $project->getUnapprovedCount(); echo '</span></a></li>
                    <li><a href="'; echo URL_BASE; echo '/public/projects/index/true">Moje</a></li>
                    <li><a href="'; echo URL_BASE; echo '/public/projects">Vsetky</a></li>
                </ul>';
            echo '<li><a class="'; echo $this->isNavLinkActive('create_project') ? 'active' : ''; echo '" href="'; echo URL_BASE; echo '/public/create_project">Vytvorit projekt</a></li>';
            echo '</ul>';
            echo '<ul class="nav navbar-nav navbar-right">';
            echo '<li><a href="'; echo URL_BASE; echo '/public/home/logout">Odhlasenie <span class="glyphicon glyphicon-log-out grey"></span></a></li>';
            echo '</ul>';
                            } else if (User::hasLoggedUserAccess('zadavatel')) {            
            echo '<li class="dropdown">
                <a class="dropdown-toggle '; echo $this->isNavLinkActive('projects') ? 'active' : ''; echo '" data-toggle="dropdown" href="#">Zoznam projektov
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="'; echo URL_BASE; echo '/public/projects/index/true">Moje</a></li>
                    <li><a href="'; echo URL_BASE; echo '/public/projects">Vsetky</a></li>
                </ul>';
            echo '<li><a class="'; echo $this->isNavLinkActive('create_project') ? 'active' : ''; echo '" href="'; echo URL_BASE; echo '/public/create_project">Vytvorit projekt</a></li>';
            echo '</ul>';
            echo '<ul class="nav navbar-nav navbar-right">';
            echo '<li><a href="'; echo URL_BASE; echo '/public/home/logout">Odhlasenie <span class="glyphicon glyphicon-log-out grey"></span></a></li>';
            echo '</ul>';
                            } else {
            echo '<li class="dropdown">
                <a class="dropdown-toggle '; echo $this->isNavLinkActive('group') ? 'active' : ''; echo '" data-toggle="dropdown" href="#">Administracia skupiny
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="'; echo URL_BASE; echo '/public/groups/index">Vytvorit</a></li>
                    <li><a href="'; echo URL_BASE; echo '/public/groups/edit">Upravit</a></li>
                </ul>';
            echo '<li><a class="'; echo $this->isNavLinkActive('projects') ? 'active' : ''; echo '" href="'; echo URL_BASE; echo '/public/projects">Zoznam projektov</a></li>';
            echo '<li><a class="'; echo $this->isNavLinkActive('select') ? 'active' : ''; echo '" href="'; echo URL_BASE; echo '/public/select">Vyber projektu</a></li>';
            echo '</ul>';
            echo '<ul class="nav navbar-nav navbar-right">';
            echo '<li><a href="'; echo URL_BASE; echo '/public/home/logout">Odhlasenie <span class="glyphicon glyphicon-log-out grey"></span></a></li>';
            echo '</ul>';
                            }
                        } else {
            echo '<li><a href="'; echo URL_BASE; echo '/public/projects" class="'; echo $this->isNavLinkActive('projects') ? 'active' : ''; echo '">Zoznam projektov</a></li>';
            echo '</ul>';
            echo '<ul class="nav navbar-nav navbar-right">';
            echo '<li><a href="'; echo URL_BASE; echo '/public/login">Prihlasenie <span class="glyphicon glyphicon-log-in grey"></span></a></li>';
            echo '</ul>';
                }
    ?>
</div>
