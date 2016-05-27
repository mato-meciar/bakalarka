<?php
require_once dirname(dirname(dirname(__FILE__))) . "/models/DBtables/Group.php";
require_once dirname(dirname(dirname(__FILE__))) . "/models/DBtables/Project.php";

$groupId = Group::getGroupByLeader($_SESSION['uid'])['id'];
$projectId = Project::getProjectIdByGroupId($groupId);
$projekt = Project::getProject($projectId);
?>
	<h2>Váš pridelený projekt</h2><br>
<?php if ($projekt != null): ?>
	<table class="table table-striped table-bordered">
		<tbody>
		<tr>
			<th style="width: 150px;">Názov projektu:</th>
			<td><strong><?= $projekt['nazov'] ?></strong></td>
		</tr>
		<tr>
			<th>Popis projektu:</th>
			<td><?= $projekt['popis'] ?></td>
		</tr>
		<tr>
		<tr>
			<th>Oblasť projektu:</th>
			<td><?= preg_replace('/(?<!\d)[.,!?](?!\d)/', ', ', $projekt['oblast']); ?></td>
		</tr>
		<tr>
			<th>Platforma projektu:</th>
			<td><?= preg_replace('/(?<!\d)[.,!?](?!\d)/', ', ', $projekt['platforma']); ?></td>
		</tr>
		<tr>
			<th>Technológie projektu:</th>
			<td><?= preg_replace('/(?<!\d)[.,!?](?!\d)/', ', ', $projekt['technologie']); ?></td>
		</tr>
		</tbody>
	</table>
<?php else: ?>
	<div class="alert alert-info">
		Projekty ešte neboli pridelené!
	</div>
<?php endif; ?>