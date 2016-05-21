<!DOCTYPE html>

<html lang="sk">
<head>
    <title>Tvorba informacnych systemov</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= URL_BASE ?>/public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= URL_BASE ?>/public/css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="<?= URL_BASE ?>/public/css/tagmanager.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= URL_BASE ?>/public/css/sidebar.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= URL_BASE ?>/public/css/style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?= URL_BASE ?>/public/js/bootstrap.min.js"></script>
    <script src="<?= URL_BASE ?>/public/js/validator.js"></script>
    <script src="<?= URL_BASE ?>/public/js/tagmanager.js"></script>
    <script src="<?= URL_BASE ?>/public/js/scripts.js"></script>
</head>

<body>

    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <?php require_once "navigation.php"; ?>
        </div>
    </div>

    <div class="container">
        <div class="col-md-12">
            <?php require_once $view.'.php'; ?>
        </div>
    </div>
</body>
</html>