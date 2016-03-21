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
        <h2>Administracia skupiny</h2>
        <div class="well">
            <form>
                <div class="form-group">
                    <label for="group_name">Nazov skupiny</label>
                    <input type="text" class="form-control" id="group_name">
                </div>
                <div class="form-group">
                    <label for="group_contact">Kontaktny email</label>
                    <input type="text" class="form-control" id="group_contact">
                </div>
                <div class="form-group">
                    <label for="group_members">Clenovia skupiny</label>
                    <textarea class="form-control" rows="5" id="group_mambers"></textarea>
                </div>
                <div class="form-group">
                    <label for="group_skills">Skusenosti</label>
                    <input type="text" class="form-control" id="group_skills">
                </div>
                <button type="submit" class="btn btn-info">Ulozit zmeny</button>
            </form>
        </div>
    </div>
</body>
</html>