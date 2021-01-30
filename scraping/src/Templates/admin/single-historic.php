<?php ob_start();
$title = "2021/01/05"
?>
    <p class="under-title">ANSSI</p>
    <p class="info"> Dowload extraction</p>

    <table class="tab">
        <tr class="tab-head">
            <th>Data</th>
            <th>Name</th>
            <th>Type</th>
        </tr>
        <tr>
            <td>The cybersecurity</td>
            <td>Title of the article</td>
            <td>Text</td>
        </tr>
        <tr>
            <td>2021/01/21</td>
            <td>Date of the article</td>
            <td>Date</td>
        </tr>
    </table>
    <?php include '../../parts/_pagination.php'; ?>

    <div class="info-bottom">
        <p>Reference : 1</p>
        <p>Delete</p>
    </div>
    
   

<?php
$content = ob_get_clean();
require('_template-admin.php');
?>