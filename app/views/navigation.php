<div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse" aria-expanded="false">
        <span class="sr-only">Zobraziť menu</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>        
    </button>
    <?php if (User::isLoggedUser()) {
        echo '<a class="navbar-brand" href="';
        echo URL_BASE;
        echo '/public/home">Tvorba informačných systémov</a>';
    } else {
        echo '<a class="navbar-brand" href="';
        echo URL_BASE;
        echo '/public/login">Tvorba informačných systémov</a>';
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
                    <li><a href="';
                                echo URL_BASE;
                                echo '/public/projects/approval">Na schválenie <span class="badge">';
                                echo Project::getUnapprovedCount();
                                echo '</span></a></li>
                    <li><a href="'; echo URL_BASE; echo '/public/projects/index/true">Moje</a></li>
                    <li><a href="';
                                echo URL_BASE;
                                echo '/public/projects">Všetky</a></li>
                </ul>';
                                echo '<li><a class="';
                                echo $this->isNavLinkActive('create_project') ? 'active' : '';
                                echo '" href="';
                                echo URL_BASE;
                                echo '/public/create_project">Vytvoriť projekt</a></li>';
                                echo '<li><a class="';
                                echo $this->isNavLinkActive('selection') ? 'active' : '';
                                echo '" href="';
                                echo URL_BASE;
                                echo '/public/selection">Priradenie projektov</a></li>';
            echo '</ul>';
            echo '<ul class="nav navbar-nav navbar-right">';
                                echo '<li><a class="';
                                echo $this->isNavLinkActive('settings') ? 'active' : '';
                                echo '" href="';
                                echo URL_BASE;
                                echo '/public/settings/index"';
                                echo '>Nastavenia <span class="glyphicon glyphicon-cog"></span></a></li>';
                                echo '<li><a href="';
                                echo URL_BASE;
                                echo '/public/home/logout">Odhlásenie <span class="glyphicon glyphicon-log-out grey"></span></a></li>';
            echo '</ul>';
                            } else if (User::hasLoggedUserAccess('zadavatel')) {            
            echo '<li class="dropdown">
                <a class="dropdown-toggle '; echo $this->isNavLinkActive('projects') ? 'active' : ''; echo '" data-toggle="dropdown" href="#">Zoznam projektov
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="'; echo URL_BASE; echo '/public/projects/index/true">Moje</a></li>
                    <li><a href="';
                                echo URL_BASE;
                                echo '/public/projects">Všetky</a></li>
                </ul>';
                                echo '<li><a class="';
                                echo $this->isNavLinkActive('create_project') ? 'active' : '';
                                echo '" href="';
                                echo URL_BASE;
                                echo '/public/create_project">Vytvoriť projekt</a></li>';
            echo '</ul>';
            echo '<ul class="nav navbar-nav navbar-right">';
                                echo '<li><a href="';
                                echo URL_BASE;
                                echo '/public/home/logout">Odhlásenie <span class="glyphicon glyphicon-log-out grey"></span></a></li>';
            echo '</ul>';
                            } else {
            echo '<li class="dropdown">
                <a class="dropdown-toggle ';
                                echo $this->isNavLinkActive('group') ? 'active' : '';
                                echo '" data-toggle="dropdown" href="#">Administrácia skupiny
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="';
                                echo URL_BASE;
                                echo '/public/groups/index">Vytvoriť</a></li>
                    <li><a href="';
                                echo URL_BASE;
                                echo '/public/groups/edit">Upraviť</a></li>
                    <li><a href="';
                                echo URL_BASE;
                                echo '/public/groups/show">Náš projekt</a></li>
                </ul>';
            echo '<li><a class="'; echo $this->isNavLinkActive('projects') ? 'active' : ''; echo '" href="'; echo URL_BASE; echo '/public/projects">Zoznam projektov</a></li>';
                                echo '<li><a class="';
                                echo $this->isNavLinkActive('select') ? 'active' : '';
                                echo '" href="';
                                echo URL_BASE;
                                echo '/public/select">Výber projektu</a></li>';
            echo '</ul>';
            echo '<ul class="nav navbar-nav navbar-right">';
                                echo '<li><a href="';
                                echo URL_BASE;
                                echo '/public/home/logout">Odhlásenie <span class="glyphicon glyphicon-log-out grey"></span></a></li>';
            echo '</ul>';
                            }
                        } else {
            echo '<li><a href="'; echo URL_BASE; echo '/public/projects" class="'; echo $this->isNavLinkActive('projects') ? 'active' : ''; echo '">Zoznam projektov</a></li>';
            echo '</ul>';
            echo '<ul class="nav navbar-nav navbar-right">';
            echo '<li><a href="';
            echo URL_BASE;
            echo '/public/login">Prihlásenie <span class="glyphicon glyphicon-log-in grey"></span></a></li>';
            echo '</ul>';
                }
    ?>
</div>
