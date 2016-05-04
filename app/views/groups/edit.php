<?php
    require_once dirname(dirname(dirname(__FILE__)))."/controllers/API.php";
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['members']) && isset($_POST['skills'])) {
            $api = new API();
            $result = $api->updateGroup($data['groupInfo']['id']);
            if ($result) {
                unset($_POST);
                header("location:javascript://window.history.go(-1); return false;");
            }
        }
?>
<h2>Upravenie skupiny</h2>
<?php $group = new Group(); if(!$group->existsGroupByLeader($_SESSION['uid'])): ?>
    <div class="alert alert-danger">
        Este nemate vytvorenu skupinu! Musite ju najskor <a href="<?= URL_BASE?>/public/groups/index">vytvorit</a>.
    </div>
<?php else: ?>
    <div class="well">
        <form method="post" role="form" id="createGroupForm" data-toggle="validator">
            <div class="form-group">
                <label for="name">Nazov skupiny</label>
                <input type="text" class="form-control" id="name" name="name" value="<?=$data['groupInfo']['nazov']?>" required>
            </div>
            <div class="form-group">
                <label for="email">Kontaktny email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?=$data['groupInfo']['email']?>" data-error="Neplatna e-mailova adresa" required>
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
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Ulozit zmeny</button>
        </form>
    </div>
<?php endif; ?>
<script>
    jQuery(".tm-input-members").tagsManager({hiddenTagListName: 'members', delimiters: [44, 13], prefilled: <?php echo json_encode(explode(',', $data['groupInfo']['clenovia'])); ?>});
    jQuery(".tm-input-skills").tagsManager({hiddenTagListName: 'skills', delimiters: [44, 13], prefilled: <?php echo json_encode(explode(',', $data['groupInfo']['schopnosti'])); ?>});
</script>