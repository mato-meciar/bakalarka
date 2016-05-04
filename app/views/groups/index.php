<h2>Vytvorenie skupiny</h2>
<?php $group = new Group(); if(!$group->existsGroupByLeader($_SESSION['uid'])): ?>
    <div class="well">
        <form method="post" role="form" id="createGroupForm" data-toggle="validator">
            <div class="form-group">
                <label for="name">Nazov skupiny</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Kontaktny email</label>
                <input type="email" class="form-control" id="email" name="email" data-error="Neplatna e-mailova adresa" required>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label for="members">Clenovia skupiny</label>
                <div>
                    <input type="text" class="form-control tm-input-members" id="members">
                </div>
            </div>
            <div class="form-group">
                <label for="skills">Skusenosti</label>
                <div>
                    <input type="text" class="form-control tm-input-skills" id="skills">
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Vytvorit skupinu">
        </form>
    </div>
<?php else: ?>
    <div class="alert alert-danger">
        Uz mate vytvorenu skupinu! Mozete ju uz len <a href="<?= URL_BASE?>/public/groups/edit">upravovat</a>.
    </div>
<?php endif; ?>
<script>
    jQuery(".tm-input-members").tagsManager({hiddenTagListName: 'members', delimiters: [44, 13]});
    jQuery(".tm-input-skills").tagsManager({hiddenTagListName: 'skills', delimiters: [44, 13]});
</script>

<?php
    require_once dirname(dirname(dirname(__FILE__)))."/controllers/API.php";
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['members']) && isset($_POST['skills'])) {
            $api = new API();
            $result = $api->createGroup();
            if ($result) {
                unset($_POST);
            }
        }
?>