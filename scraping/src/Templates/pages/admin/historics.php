<?php ob_start();
$title = "ANSSI"
?>
    <p class="under-title">1/day</p>
    <p class="info">+ Start extraction</p>

    <table class="tab">
        <tr class="tab-head">
            <th>Date</th>
            <th>Reference</th>
        </tr>
        <tr>
            <td>2021/01/25</td>
            <td>2</td>
        </tr>
        <tr>
            <td>2021/01/25</td>
            <td>1</td>
        </tr>
    </table>
    <?php include '../../parts/_pagination.php'; ?>

    <div class="info-bottom">
        <p>Category : Information</p>
        <p>Delete all historic</p>
    </div>
    
   

<?php
$content = ob_get_clean();
require('_template-admin.php');
?>