<?php
    require_once dirname(dirname(dirname(__FILE__)))."\\controllers\\API.php";
        if (isset($_POST['name']) && isset($_POST['details']) && isset($_POST['domain']) && isset($_POST['platform']) && isset($_POST['technologies'])) {
            $api = new API();
            $result = $api->updateProject($data['projectInfo']['id']);
            if ($result) {
                unset($_POST);
                header("location:javascript://window.history.go(-1); return false;");
            }
        }
?>

<h2>Uprava projektu</h2>
<div class="well">
    <form method="post" role="form" id="createProjectForm">
        <div class="form-group">
            <label for="name">Nazov projektu</label>
            <input type="text" class="form-control" name="name" required value="<?=$data['projectInfo']['nazov']?>">
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
            <button id="back" class="btn btn-danger" onclick="window.history.go(-2); return false;"><span class="glyphicon glyphicon-chevron-left"></span> Spat</button>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Ulozit zmeny</button>
        </div>
    </form>
</div>

<script>
    jQuery(".tm-input-domain").tagsManager({hiddenTagListName: 'domain', delimiters: [44, 13], prefilled: <?php echo json_encode(explode(',', $data['projectInfo']['oblast'])); ?>});
    jQuery(".tm-input-platform").tagsManager({hiddenTagListName: 'platform', delimiters: [44, 13], prefilled: <?php echo json_encode(explode(',', $data['projectInfo']['platforma'])); ?>});
    jQuery(".tm-input-technologies").tagsManager({hiddenTagListName: 'technologies', delimiters: [44, 13], prefilled: <?php echo json_encode(explode(',', $data['projectInfo']['technologie'])); ?>});
</script>