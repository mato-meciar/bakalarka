<!DOCTYPE html>

<html lang="sk">
<head>
    <title>Tvorba informacnych systemov</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="<?= URL_BASE ?>/public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= URL_BASE ?>/public/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= URL_BASE ?>/public/css/bootstrap-datetimepicker.min.css" rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" href="<?= URL_BASE ?>/public/css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="<?= URL_BASE ?>/public/css/tagmanager.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= URL_BASE ?>/public/css/sidebar.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= URL_BASE ?>/public/css/style.css" rel="stylesheet" type="text/css">
    <script src="<?= URL_BASE ?>/public/js/jquery-2.2.4.min.js"></script>
    <script src="<?= URL_BASE ?>/public/js/bootstrap.min.js"></script>
    <script src="<?= URL_BASE ?>/public/js/moment.js"></script>
    <script src="<?= URL_BASE ?>/public/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?= URL_BASE ?>/public/js/affix.js"></script>
    <script src="<?= URL_BASE ?>/public/js/alert.js"></script>
    <script src="<?= URL_BASE ?>/public/js/button.js"></script>
    <script src="<?= URL_BASE ?>/public/js/carousel.js"></script>
    <script src="<?= URL_BASE ?>/public/js/collapse.js"></script>
    <script src="<?= URL_BASE ?>/public/js/dropdown.js"></script>
    <script src="<?= URL_BASE ?>/public/js/modal.js"></script>
    <script src="<?= URL_BASE ?>/public/js/popover.js"></script>
    <script src="<?= URL_BASE ?>/public/js/scrollspy.js"></script>
    <script src="<?= URL_BASE ?>/public/js/tab.js"></script>
    <script src="<?= URL_BASE ?>/public/js/tooltip.js"></script>
    <script src="<?= URL_BASE ?>/public/js/scripts.js"></script>
    <script src="<?= URL_BASE ?>/public/js/validator.js"></script>
    <script src="<?= URL_BASE ?>/public/js/tagmanager.js"></script>
</head>

<body>

<div class="navbar navbar-inverse">
        <div class="container">
            <?php require_once "navigation.php"; ?>
        </div>
    </div>

    <div class="container">
        <div class="col-md-12">
            <?php require_once $view . '.php'; ?>
        </div>
    </div>
</body>
</html>