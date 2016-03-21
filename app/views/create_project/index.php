<!DOCTYPE html>

<html lang="sk">
<head>
    <title>Tvorba informacnych systemov</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>
<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <!-- logo -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="./home" class="navbar-brand">Tvorba informacnych systemov</a>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <h2>Vytvorenie projektu</h2>
        <div class="well">
            <form>
                <div class="form-group">
                    <label for="project_name">Nazov projektu</label>
                    <input type="text" class="form-control" id="project_name">
                </div>
                <div class="form-group">
                    <label for="project_details">Popis projektu</label>
                    <textarea class="form-control" rows="5" id="project_details"></textarea>
                </div>
                <div class="form-group">
                    <label for="project_domain">Oblast projektu</label>
                    <input type="text" class="form-control" id="project_domain">
                </div>
                <div class="form-group">
                    <label for="project_platform">Platforma projektu</label>
                    <input type="text" class="form-control" id="project_platform">
                </div>
                <div class="form-group">
                    <label for="project_technologies">Technologie projektu</label>
                    <input type="text" class="form-control" id="project_technologies">
                </div>
                <button type="submit" class="btn btn-info">Postupit projekt na schvalovanie</button>
            </form>
        </div>
    </div>
</body>
</html>