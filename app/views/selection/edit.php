<?php
//require_once dirname(dirname(dirname(__FILE__))) . "/core/GA.php";
require_once dirname(dirname(dirname(__FILE__))) . "/models/DBtables/Group.php";
require_once dirname(dirname(dirname(__FILE__))) . "/models/DBtables/Project.php";

if (isset($_SESSION['assignment'])) {
	$assignment = $_SESSION['assignment'];
	$execution_time = $_SESSION['elapsed'];
}

?>

<h2>Manualne upravenie pridelenych projektov</h2>

<form name="editAssignments" action="<?= URL_BASE . '/public/selection/assign/' ?>">

	<table class="table table-hover table-bordered" id="resultsTable">
		<thead>
		<tr>
			<th style="width: 150px;">Nazov skupiny</th>
			<th>Clenovia skupiny</th>
			<th>Vyberte projekt</th>
		</tr>
		</thead>
		<tbody>
		<?php

		$allProjects = Project::getProjectListOrderById();
		foreach ($assignment as $projectId => $groupId) {
			echo '<tr>';
			$skupina = Group::getGroup($groupId);
			$projekt = Project::getProject($projectId);
			echo '<td>' . $skupina['nazov'] . '</td>';
			$mena = "";
			foreach (explode(',', $skupina['clenovia']) as $meno) {
				$wholeName = "";
				foreach (explode(' ', $meno) as $namePart) {
					$wholeName .= ucfirst(strtolower($namePart));
				}
				$mena .= $wholeName . ", ";
			}
			echo '<td>' . substr($mena, 0, -2) . '</td>';
			echo '<td><select name="' . $groupId . '" class="form-control">';
			foreach ($allProjects as $key => $value) {
				if ($value['id'] == $projectId) {
					echo "<option value='" . $value['id'] . "' selected>" . $value['nazov'] . "</option>\r\n";
				} else {
					echo "<option value='" . $value['id'] . "'>" . $value['nazov'] . "</option>\r\n";
				}
			}
			echo '</select></td>';
			echo '</tr>';
		}
		?>
		</tbody>
	</table>
	<a class="btn btn-danger" href="<?= URL_BASE . '/public/selection' ?>"><span
			class="glyphicon glyphicon-chevron-left"></span> Späť</a>
	<button type="button" class="btn btn-success" onclick="validate()"><span class="glyphicon glyphicon-save"></span>
		Ulozit priradenie
	</button>
	<button type="submit" formmethod="post" id="btnSubmit" class="hidden"
	"><span class="glyphicon glyphicon-save"></span> Ulozit priradenie</button>
</form>

<script>
	function validate() {
		var allSelects = document.getElementsByClassName("form-control");
		var selectsArray = [];

		for (var i = 0; i < allSelects.length; ++i) {
			selectsArray[i] = allSelects[i].value;
		}

		selectsArray = selectsArray.slice().sort();
		var error = false;
		for (var i = 0; i < selectsArray.length - 1; i++) {
			if (selectsArray[i] == selectsArray[i + 1]) {
				error = true;
				alert("Niektorý projekt je priradený k viacerým skupinám!");
				break;
			}
		}
		if (!error) {
			var submitBtn = document.getElementById("btnSubmit");
			submitBtn.click();
		}


	}
</script>
