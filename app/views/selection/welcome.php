<h2>Automatické priradenie projektov</h2>
<?php
require_once dirname(dirname(dirname(__FILE__))) . "/models/DBtables/Group.php";
require_once dirname(dirname(dirname(__FILE__))) . "/models/DBtables/Project.php";

//Project::resetAssignments();
if (isset($_SESSION['assignment']) || (intval($_SESSION['boli_pridelene']) == 1)) :
	?>
	<div class="alert alert-warning alert-dismissable fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Automatické priraďovanie už prebehlo.
	</div>
	<div>
		<a class="btn btn-info" href="<?= URL_BASE . "/public/selection" ?>"><span
				class="glyphicon glyphicon-chevron-left"></span> Späť</a>
	</div>
<?php else: ?>
	<div class="alert alert-warning alert-dismissable fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Automatické priraďovanie trvá dlhšie a prehliadač sa môže javiť, že "zamrzol".
		Toto je však normálne a stačí len počkať, kým sa dokončí výpočet.
	</div>
	<div>
		<strong>Pre spustenie automatického priraďovania projektov kliknite na tlačidlo nižšie.</strong>
	</div>
	<div>
		<a class="btn btn-primary" href="<?= URL_BASE . "/public/selection" ?>"><span
				class="glyphicon glyphicon-random"></span>&nbsp;&nbsp;Spustiť priraďovanie</a>
	</div>
<?php endif; ?>