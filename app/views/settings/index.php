<?php
require_once dirname(dirname(dirname(__FILE__))) . "/controllers/API.php";

$_SESSION['vytvaranie_skupin'] = API::getGroupCreationDate();

if (isset($_POST) && !empty($_POST)) {
	$date = new DateTime($_POST['vytvaranie_skupin'] . " 23:59:59");
	$date = $date->format("Y-m-d H:i:s");
	API::writeDate($date);
	$_SESSION['vytvaranie_skupin'] = API::getGroupCreationDate();
}
?>

<h2>Nastavenia predmetu</h2><br>

<div class="well">
	<form role="form" method="post" id="settingsForm">
		<div class="form-group">
			<label for="vytvaranie_skupin">Skupiny je možné vytvárať a editovať do:</label>
			<div class="row">
				<div class='col-sm-4'>
					<div class="form-group">
						<div class='input-group date' id='vytvaranie_skupin'>
							<input type='text' class="form-control" id="vytvaranie_skupin" name="vytvaranie_skupin"
							       value="<?= $_SESSION['vytvaranie_skupin'] ?>"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					$(function () {
						$('#vytvaranie_skupin').datetimepicker({format: 'DD.MM.YYYY'});
					});
				</script>
			</div>
		</div>
		<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Uložiť nastavania
		</button>
	</form>
</div>
