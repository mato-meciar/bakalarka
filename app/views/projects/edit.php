<?php
    require_once dirname(dirname(dirname(__FILE__)))."/controllers/API.php";
        if (isset($_POST['name']) && isset($_POST['details']) && isset($_POST['domain']) && isset($_POST['platform']) && isset($_POST['technologies'])) {
	        $result = API::updateProject($data['projectInfo']['id']);
            if ($result) {
                unset($_POST);
	            self::redirect(URL_BASE . "/public/projects/index/true");
            }
        }
?>

<h2>Úprava projektu</h2>
<div class="well">
	<form method="post" role="form" id="createProjectForm" accept-charset="utf-8">
        <div class="form-group">
	        <label for="name">Názov projektu</label>
            <input type="text" class="form-control" name="name" required value="<?=$data['projectInfo']['nazov']?>">
        </div>
		<div class="form-group">
			<label for="important">Dôležitý projekt</label>
			<br>
			<div class="radio radio-inline"><input type="radio" id="yes" name="important"
			                                       value="ano" <?= (intval($data['projectInfo']['dolezity']) == 1) ? "checked" : "" ?>><label
					for="yes">áno</label></div>
			<div class="radio radio-inline"><input type="radio" id="no" name="important"
			                                       value="no" <?= (intval($data['projectInfo']['dolezity']) == 0) ? "checked" : "" ?>><label
					for="no">nie</label></div>
		</div>
		<div class="form-group">
			<label for="name">Kontaktný e-mail</label>
			<input type="text" class="form-control" name="email" value="<?= $data['projectInfo']['kontaktny_email'] ?>">
		</div>
        <div class="form-group">
            <label for="details">Popis projektu</label>
            <textarea class="form-control" rows="5" name="details" required><?=$data['projectInfo']['popis']?></textarea>
        </div>
        <div class="form-group">
            <label for="domain">Oblast projektu</label>
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
            <label for="technologies">Technologie projektu</label><br>
            <div>
                <input type="text" class="form-control tm-input-technologies" id="technologies">
            </div>
        </div>
        <div>
	        <a class="btn btn-info" href="<?= URL_BASE . '/public/projects/index/true' ?>"><span
			        class="glyphicon glyphicon-chevron-left"></span> Späť</a>
	        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Uložiť zmeny
	        </button>
        </div>
    </form>
</div>

<script>
    jQuery(".tm-input-domain").tagsManager({hiddenTagListName: 'domain', delimiters: [44, 13], prefilled: <?php echo json_encode(explode(',', $data['projectInfo']['oblast'])); ?>});
    jQuery(".tm-input-platform").tagsManager({hiddenTagListName: 'platform', delimiters: [44, 13], prefilled: <?php echo json_encode(explode(',', $data['projectInfo']['platforma'])); ?>});
    jQuery(".tm-input-technologies").tagsManager({hiddenTagListName: 'technologies', delimiters: [44, 13], prefilled: <?php echo json_encode(explode(',', $data['projectInfo']['technologie'])); ?>});
</script>