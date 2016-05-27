<?php
require_once dirname(dirname(dirname(__FILE__))) . "/models/DBtables/Group.php";
require_once dirname(dirname(dirname(__FILE__))) . "/models/DBtables/Project.php";

if (intval(API::getAssignedSetting()) == 1 && (User::hasLoggedUserAccess("uzivatel") || !User::isLoggedUser())) : ?>
	<h2>Výsledky automatického priradenia projektov</h2>
	<?php if (isset($_SESSION['elapsed'])) {
		echo '<div class="well">';
		echo 'Dĺžka priraďovania: <strong>' . $_SESSION['elapsed'] . ' s</strong>.';
		echo '</div>';
	}
	$assignment = Project::getAssignedProjectListIds(); ?>

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
<?php endif;
if (intval(API::getAssignedSetting()) != 1 || User::hasLoggedUserAccess("zadavatel") || User::hasLoggedUserAccess("admin")):
	?>
<h2>Zoznam projektov</h2>
	<div class="text-center">

		<table class="table table-hover table-bordered table-list-link">
			<thead>
			<tr>
				<th style="width: 150px;">Názov</th>
				<th>Popis</th>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach ($data['listProjects'] as $row) {
				echo '<tr onclick="elementOnClick(this)" href="' . URL_BASE . '/public/projects/detail/' . $row['id'] . '">';
				echo '<td>' . $row['nazov'] . '</td>';
				echo '<td>' . $row['popis'] . '</td>';
				echo '</tr>';
			}
			?>
			</tbody>
		</table>
	</div>
<?php endif; ?>