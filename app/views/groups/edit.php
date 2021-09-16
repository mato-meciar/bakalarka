<h2>Upravenie skupiny</h2>
<?php
require_once dirname(dirname(dirname(__FILE__))) . "/controllers/api.php";
$limit = new DateTime(API::getGroupCreationDate(true));
$today = new DateTime('now');
if ($today > $limit) :
?>
	<div class="alert alert-danger">
		Skupiny už nie je možné upravovať!
	</div>
	<?php if (isset($result) && $result == false) :
	?>
	<div class="alert alert-danger alert-dismissable fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Skupina nebola vytvorená! Skontrolujte, či ste vyplnili všetky polia!
	</div>
<?php endif;
elseif (!Group::existsGroupByLeader($_SESSION['uid'])): ?>
    <div class="alert alert-danger">
	    Ešte nemáte vytvorenú skupinu! Musíte ju najskôr <a href="<?= URL_BASE ?>/public/groups/index">vytvoriť</a>.
    </div>
<?php else: ?>
    <div class="well">
	    <form method="post" role="form" id="createGroupForm" data-toggle="validator" accept-charset="utf-8">
            <div class="form-group">
	            <label for="name">Názov skupiny</label>
                <input type="text" class="form-control" id="name" name="name" value="<?=$data['groupInfo']['nazov']?>" required>
            </div>
            <div class="form-group">
	            <label for="email">Kontaktný e-mail</label>
                <input type="text" class="form-control" id="email" name="email" value="<?=$data['groupInfo']['email']?>" data-error="Neplatna e-mailova adresa" required>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
	            <label for="members">Členovia skupiny</label>
                <div>
                    <input type="text" class="form-control tm-input-members" id="members">
                </div>
            </div>
            <div class="form-group">
	            <label for="skills">Skúsenosti</label>
                <div>
                    <input type="text" class="form-control tm-input-skills" id="skills">
                </div>
            </div>
		    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Uložiť zmeny
		    </button>
        </form>
    </div>
<script>
    jQuery(".tm-input-members").tagsManager({hiddenTagListName: 'members', delimiters: [44, 13], prefilled: <?php echo json_encode(explode(',', $data['groupInfo']['clenovia'])); ?>});
    jQuery(".tm-input-skills").tagsManager({hiddenTagListName: 'skills', delimiters: [44, 13], prefilled: <?php echo json_encode(explode(',', $data['groupInfo']['schopnosti'])); ?>});
</script>
<?php endif;

require_once dirname(dirname(dirname(__FILE__))) . "/controllers/api.php";
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['members']) && isset($_POST['skills'])) {
	$result = API::updateGroup($data['groupInfo']['id']);
	if ($result) {
		unset($_POST);
		self::redirect(URL_BASE . "/public/groups/edit");
	}
}
?>

