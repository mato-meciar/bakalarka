<h2>Zoznam projektov</h2>

<table class="table table-hover table-bordered table-list-link">
    <thead>
        <tr>
            <th style="width: 150px;">Nazov</th>
            <th>Popis</th>
        </tr>
    </thead>
    <tbody>
        <?php
//            var_dump($data);
            foreach ($data['listProjects'] as $row) {
                echo '<tr onclick="elementOnClick(this)" href="' . URL_BASE . '/public/projects/detail/' . $row['id'] . '">';
                echo '<td>' . $row['nazov'] . '</td>';
                echo '<td>' . $row['popis'] . '</td>';
                echo '</tr>';
            }
        ?>
    </tbody>
</table>