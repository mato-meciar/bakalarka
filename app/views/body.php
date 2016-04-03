<!DOCTYPE html>

<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="29418959227-cea5c0a516p6nr0ef8n41mh51c4bm05h.apps.googleusercontent.com">

<html lang="sk">
<head>
    <title>Tvorba informacnych systemov</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= URL_BASE ?>/public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!--<link rel="stylesheet" href="<?= URL_BASE ?>/public/css/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />-->
    <link rel="stylesheet" href="<?= URL_BASE ?>/public/css/tagmanager.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= URL_BASE ?>/public/css/sidebar.css">
    <link rel="stylesheet" href="<?= URL_BASE ?>/public/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?= URL_BASE ?>/public/js/bootstrap.min.js"></script>
    <script src="<?= URL_BASE ?>/public/js/validator.js"></script>
    <!--<script src="<?= URL_BASE ?>/public/js/bootstrap-tagsinput.js"></script>-->
    <script src="<?= URL_BASE ?>/public/js/tagmanager.js"></script>
</head>

<body>

    <div id="wrapper">
        <div id="sidebar-wrapper">
            <?php require_once "navigation.php"; ?>
        </div>
        
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php require_once $view.'.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>