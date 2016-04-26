<h2>Zoznam projektov cakajucich na schvalenie</h2>

<table class="table table-hover table-bordered table-list-link">
    <thead>
        <tr>
            <th style="width: 150px;">Nazov</th>
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