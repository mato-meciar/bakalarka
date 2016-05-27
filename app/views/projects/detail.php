<h2><?=$data['projectInfo']['nazov']?></h2>
<table class="table table-striped table-bordered">
    <tbody>
        <tr>
	        <th style="width: 150px;">Popis projektu:</th>
            <td><?=$data['projectInfo']['popis']?></td>
        </tr>
        <tr>
	        <th>Oblasť projektu:</th>
            <td><?=preg_replace('/(?<!\d)[.,!?](?!\d)/', ', ', $data['projectInfo']['oblast']);?></td>
        </tr>
        <tr>
            <th>Platforma projektu:</th>
            <td><?=preg_replace('/(?<!\d)[.,!?](?!\d)/', ', ', $data['projectInfo']['platforma']);?></td>
        </tr>
        <tr>
	        <th>Technológie projektu:</th>
            <td><?=preg_replace('/(?<!\d)[.,!?](?!\d)/', ', ', $data['projectInfo']['technologie']);?></td>
        </tr>
    </tbody>
</table>
<button id="back" class="btn btn-info" onclick="window.history.go(-1); return false;"><span
		class="glyphicon glyphicon-chevron-left"></span> Späť
</button>
<?php
if (User::isLoggedUser()) {
	if (User::hasLoggedUserAccess("admin")) {
		if (intval(API::getAssignedSetting()) != 1) {
			echo '<a class="btn btn-primary" href="' . URL_BASE . '/public/projects/edit/' . $data['projectInfo']['id'] . '"><span class="glyphicon glyphicon-edit"></span> Upraviť projekt</a> ';
			if (!Project::getProjectStatus($data['projectInfo']['id'])) {
				echo '<a class="btn btn-success" href="' . URL_BASE . '/public/projects/approve/' . $data['projectInfo']['id'] . '"><span class="glyphicon glyphicon-ok"></span> Schváliť projekt</a> ';
			}
			echo '<a class="btn btn-danger" href="' . URL_BASE . '/public/projects/delete/' . $data['projectInfo']['id'] . '"><span class="glyphicon glyphicon-trash"></span> Zmazať projekt</a> ';
		}
	} else if (User::getUid($_SESSION['user']) == $data['projectInfo']['vytvoril_id']) {
		if (intval(API::getAssignedSetting()) != 1) {
			echo '<a class="btn btn-primary" href="' . URL_BASE . '/public/projects/edit/' . $data['projectInfo']['id'] . '"><span class="glyphicon glyphicon-edit"></span> Upraviť projekt</a> ';
		}
	}
}
?>
