<?php
    require_once dirname(dirname(dirname(__FILE__)))."/controllers/API.php";

    if (sizeof($_POST) > 0){
        $api = new API();
        $result = $api->projectPreferences($_POST, $data['groupInfo']['id']);
        if ($result) {
            unset($_POST);
            header("Location: ".URL_BASE."/public/select");
        }
    }

    function getPreference($id, $pref, $data) {
        $preferencie = explode(";", $data['groupInfo']['preferencie']);
        foreach ($preferencie as $value) {
            if ($value == "$id:$pref") {
                return "checked";
            }
        }
    }
    
?>

<h2>Vyber projektu</h2>
<?php $group = new Group(); if(!$group->existsGroupByLeader($_SESSION['uid'])): ?>
    <div class="alert alert-danger">
        Este nemate vytvorenu skupinu! Musite ju najskor <a href="<?= URL_BASE?>/public/groups/index">vytvorit</a>.
    </div>
<?php else: ?>


<div class="alert alert-info alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Ohodnotte aspon jeden projekt podla preferencie.
</div>
<div class="alert alert-danger alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Aj ked budete mat vybraty len 1 projekt s najvyssou preferencoiu este nemate zarucene,
    ze ho dostanete!
</div>
<form role="form" method="post">
<?php
    foreach ($data['listProjects'] as $row) { ?>
    <table class="table table-striped table-bordered">
        <tbody>
            <tr>
                <td colspan="4" title="Nazov projektu"><strong><?=$row['nazov']?></strong></td>
            </tr>
            <tr>
                <td colspan="4" class="ellipsis" title="Popis projektu"><?=$row['popis']?></td>
            </tr>
            <tr>
                <td colspan="4" title="Oblast projektu"><?=preg_replace('/(?<!\d)[.,!?](?!\d)/', ', ', $row['oblast']);?></td>
            </tr>
            <tr>
                <td colspan="4" title="Platforma projektu"><?=preg_replace('/(?<!\d)[.,!?](?!\d)/', ', ', $row['platforma']);?></td>
            </tr>
            <tr>
                <td colspan="4" title="Technologie projektu"><?=preg_replace('/(?<!\d)[.,!?](?!\d)/', ', ', $row['technologie']);?></td>
            </tr>
            <tr>
                <td title="Preferencia projektu" align="center">
                    <fieldset id="group<?=$row['id']?>">
                        <div class="radio radio-inline radio-danger">
                            <input type="radio" name="<?=$row['id']?>" id="radio_<?=$row['id']?>_1" value="1" <?= getPreference($row['id'], 1, $data);?>>
                            <label for="radio_<?=$row['id']?>_1">
                                <strong>0-24%</strong>
                            </label>
                        </div>
                </td>
                <td title="Preferencia projektu" align="center">
                        <div class="radio radio-inline radio-warning">
                            <input type="radio" name="<?=$row['id']?>" id="radio_<?=$row['id']?>_2" value="2" <?= getPreference($row['id'], 2, $data);?>>
                            <label for="radio_<?=$row['id']?>_2">
                                <strong>25-49%</strong>
                            </label>
                        </div>
                </td>
                <td title="Preferencia projektu" align="center">
                        <div class="radio radio-inline radio-info">
                            <input type="radio" name="<?=$row['id']?>" id="radio_<?=$row['id']?>_3" value="3" <?= getPreference($row['id'], 3, $data);?>>
                            <label for="radio_<?=$row['id']?>_3">
                                <strong>50-74%</strong>
                            </label>
                        </div>
                </td>
                <td title="Preferencia projektu" align="center">
                        <div class="radio radio-inline radio-success">
                            <input type="radio" name="<?=$row['id']?>" id="radio_<?=$row['id']?>_4" value="4" <?= getPreference($row['id'], 4, $data);?>>
                            <label for="radio_<?=$row['id']?>_4">
                                <strong>75-100%</strong>
                            </label>
                        </div>
                    </fieldset>
                </td>
            </tr>
        </tbody>
    </table> 

    <?php
    } ?>
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Ulozit zmeny</button>
</form>
<?php endif; ?>