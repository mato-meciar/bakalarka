
<h2><?=$data['projectInfo']['nazov']?></h2>
<table class="table table-striped table-bordered">
    <tbody>
        <tr>
            <th>Nazov projektu:</th>
            <td><?=$data['projectInfo']['nazov']?></td>
        </tr>
        <tr>
            <th>Popis projektu:</th>
            <td><?=$data['projectInfo']['popis']?></td>
        </tr>
        <tr>
            <th>Oblast projektu:</th>
            <td><?=preg_replace('/(?<!\d)[.,!?](?!\d)/', ', ', $data['projectInfo']['oblast']);?></td>
        </tr>
        <tr>
            <th>Platforma projektu:</th>
            <td><?=preg_replace('/(?<!\d)[.,!?](?!\d)/', ', ', $data['projectInfo']['platforma']);?></td>
        </tr>
        <tr>
            <th>Technologie projektu:</th>
            <td><?=preg_replace('/(?<!\d)[.,!?](?!\d)/', ', ', $data['projectInfo']['technologie']);?></td>
        </tr>
    </tbody>
</table>
<button id="back" class="btn btn-danger" onclick="window.history.go(-1); return false;"><span class="glyphicon glyphicon-chevron-left"></span> Spat</button>
<?php
    if (($_SESSION['role'] =='admin')) {
        $projekt = new Project();
        echo '<a class="btn btn-primary" href="' . URL_BASE . '/public/projects/edit/' . $data['projectInfo']['id'] . '"><span class="glyphicon glyphicon-edit"></span> Upravit projekt</a> ';
        if (!$projekt->getProjectStatus($data['projectInfo']['id'])) {
            echo '<a class="btn btn-success" href="' . URL_BASE . '/public/projects/approve/' . $data['projectInfo']['id'] . '"><span class="glyphicon glyphicon-edit"></span> Schvalit projekt</a>';
        }
    } else if ($_SESSION['uid'] == $data['projectInfo']['vytvoril_id']) {
        echo '<a class="btn btn-primary" href="' . URL_BASE . '/public/projects/edit/' . $data['projectInfo']['id'] . '"><span class="glyphicon glyphicon-edit"></span> Upravit projekt</a> ';
    }
?>
