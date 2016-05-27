<h2>Vytvorenie projektu</h2>
<?php
require_once dirname(dirname(dirname(__FILE__))) . "/controllers/API.php";
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['details']) && isset($_POST['domain']) && isset($_POST['platform']) && isset($_POST['technologies'])) {
    $result = API::createProject();
    if ($result) {
        unset($_POST); ?>
        <div class="alert alert-info alert-info fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Projekt bol vytvorený.
        </div>
        <?php
    }
}
?>
<div class="well">
    <form method="post" role="form" id="createProjectForm">
        <div class="form-group">
            <label for="name">Názov projektu</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="name">Kontaktný e-mail</label>
            <input type="text" class="form-control" name="email" required value="<?= $_SESSION['user'] ?>">
        </div>
        <div class="form-group">
            <label for="details">Popis projektu</label>
            <textarea class="form-control" rows="5" name="details" required></textarea>
        </div>
        <div class="form-group">
            <label for="domain">Oblasť projektu</label>
            <div>
                <input type="text" class="form-control tm-input-domain" id="domain">
            </div>
        </div>
        <div class="form-group">
            <label for="platform">Platforma projektu</label><br>
            <div>
                <input type="text" class="form-control tm-input-platform" id="platform">
            </div>
        </div>
        <div class="form-group">
            <label for="technologies">Technológie projektu</label><br>
            <div>
                <input type="text" class="form-control tm-input-technologies" id="technologies">
            </div>
        </div>
        <div>
            <input type="submit" class="btn btn-primary" value="Postúpiť projekt na schvaľovanie">
        </div>
    </form>
</div>

<script>
    jQuery(".tm-input-domain").tagsManager({hiddenTagListName: 'domain', delimiters: [44, 13]});
    jQuery(".tm-input-platform").tagsManager({hiddenTagListName: 'platform', delimiters: [44, 13]});
    jQuery(".tm-input-technologies").tagsManager({hiddenTagListName: 'technologies', delimiters: [44, 13]});
</script>


