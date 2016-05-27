<?php
require_once dirname(dirname(dirname(__FILE__))) . "/models/DBtables/Project.php";
Project::approve($data['projectId']); ?>

<h2>Projekt úspešne schválený!</h2><br>
<a class="btn btn-info" href="<?= URL_BASE . '/public/projects/approval' ?>"><span
		class="glyphicon glyphicon-chevron-left"></span> Späť</a>

