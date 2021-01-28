<?php ob_start();
$title = "My extractions"
?>

    <p class="info">+ Add an  extraction</p>
    <table class="tab">
        <tr class="tab-head">
            <th>Name</th>
            <th>Periodicity</th>
            <th>Category</th>
        </tr>
        <tr>
            <td>ANSSI</td>
            <td>1/day</td>
            <td>Information</td>
        </tr>
        <tr>
            <td>developpez</td>
            <td>1/week</td>
            <td>Information</td>
        </tr>
    </table>
    <?php include '../../parts/_pagination.php'; ?>


<?php
$content = ob_get_clean();
require('_template-admin.php');
?>