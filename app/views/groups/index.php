<?php
require_once dirname(dirname(dirname(__FILE__))) . "/controllers/api.php";
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['members']) && isset($_POST['skills'])) {
	$result = API::createGroup();
}
?>
<h2>Vytvorenie skupiny</h2>
<?php
$limit = new DateTime(API::getGroupCreationDate(true));
$today = new DateTime('now');

if (isset($result) && $result == false): ?>
	<div class="alert alert-danger alert-dismissable fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Skupina nebola vytvorená! Skontrolujte, či ste vyplnili všetky polia!
	</div>
	<?php
endif;
if ($today > $limit) :
	?>
	<div class="alert alert-danger">
		Skupiny už nie je možné vytvárať!
	</div>

<?php elseif (!Group::existsGroupByLeader($_SESSION['uid'])): ?>
    <div class="well">
	    <form method="post" role="form" id="createGroupForm" data-toggle="validator" accept-charset="utf-8">
            <div class="form-group">
	            <label for="name">Názov skupiny</label>
	            <input type="text" class="form-control" id="name" name="name" required
	                   value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>">
            </div>
            <div class="form-group">
	            <label for="email">Kontaktný e-mail</label>
	            <input type="email" class="form-control" id="email" name="email" data-error="Neplatna e-mailova adresa"
	                   required value="<?= $_SESSION['user'] ?>">
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
		    <input type="submit" class="btn btn-primary" value="Vytvoriť skupinu">
        </form>
    </div>
<?php else: ?>
    <div class="alert alert-danger">
	    Už máte vytvorenú skupinu! Môžete ju už len <a href="<?= URL_BASE ?>/public/groups/edit">upravovať</a>.
    </div>
<?php endif; ?>
<script>
    jQuery(".tm-input-members").tagsManager({hiddenTagListName: 'members', delimiters: [44, 13]});
    jQuery(".tm-input-skills").tagsManager({hiddenTagListName: 'skills', delimiters: [44, 13]});
</script>
