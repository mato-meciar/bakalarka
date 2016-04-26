<?php
    require_once dirname(dirname(dirname(__FILE__)))."\\models\\DBtables\\Project.php";

    $project = new Project();
    $project->approve($data['projectID']); ?>
<h2>Projekt uspesne schvaleny!</h2><br>
<button id="back" class="btn btn-danger" onclick="window.history.go(-2); return false;"><span class="glyphicon glyphicon-chevron-left"></span> Spat</button>

