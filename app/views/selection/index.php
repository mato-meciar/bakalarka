<?php
require_once dirname(dirname(dirname(__FILE__))) . "/core/GA.php";
require_once dirname(dirname(dirname(__FILE__))) . "/models/DBtables/Group.php";
require_once dirname(dirname(dirname(__FILE__))) . "/models/DBtables/Project.php";

//Project::resetAssignments();
$time_start = microtime(true);
if (!isset($_SESSION['assignment']) && (intval($_SESSION['boli_pridelene']) == 0)) {
	$pop = new Population();
	$time_end = microtime(true);
	$execution_time = round($time_end - $time_start, 2);
	$population = new Population();
	$assignment = $population->getAssignment();
	$_SESSION['assignment'] = $assignment;
	$_SESSION['elapsed'] = $execution_time;
} else {
	$assignment = Project::getAssignedProjectListIds();
}
if (isset($_SESSION['assignment'])) {
	$assignment = $_SESSION['assignment'];
}
?>

<h2>Výsledky automatického priradenia projektov</h2>
<?php if (isset($_SESSION['elapsed'])) {
	echo '<div class="well">';
	echo 'Dĺžka priraďovania: <strong>' . $_SESSION['elapsed'] . ' s</strong>.';
	echo '</div>';
} ?>

<table class="table table-hover table-bordered table-list-link" id="resultsTable">
	<thead>
	<tr>
		<th style="width: 150px;">Názov skupiny</th>
		<th>Členovia skupiny</th>
		<th>Názov projektu</th>
	</tr>
	</thead>
	<tbody>
	<?php
	foreach ($assignment as $projectId => $groupId) {
		$skupina = Group::getGroup($groupId);
		$projekt = Project::getProject($projectId);
		echo '<tr onclick="elementOnClick(this)" href="' . URL_BASE . '/public/projects/detail/' . $projectId . '">';
		echo '<td>' . $skupina['nazov'] . '</td>';
		$mena = "";
		foreach (explode(',', $skupina['clenovia']) as $meno) {
			$wholeName = "";
			foreach (explode(' ', $meno) as $namePart) {
				$wholeName .= ucfirst(mb_strtolower($namePart)) . " ";
			}
			$mena .= substr($wholeName, 0, strlen($wholeName) - 1) . ", ";
		}
		echo '<td>' . substr($mena, 0, -2) . '</td>';
		echo '<td>' . $projekt['nazov'] . '</td>';
		echo '</tr>';
	}
	?>
	</tbody>
</table>

<?php
if (User::hasLoggedUserAccess("admin")) {
	if (isset($_SESSION['boli_pridelene']) && intval($_SESSION['boli_pridelene']) == 0) {
		echo '<a class="btn btn-primary" href="' . URL_BASE . '/public/selection/edit"><span class="glyphicon glyphicon-edit"></span> Upraviť priradenie</a> ';
		echo '<a class="btn btn-success" href="' . URL_BASE . '/public/selection/assign"><span class="glyphicon glyphicon-save"></span> Uložiť priradenie</a>';
	}
}
?>
