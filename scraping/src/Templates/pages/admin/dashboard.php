<?php
require $_SERVER['DOCUMENT_ROOT'].'/Autoloader.php';
Autoloader::register();
ob_start();
$title = "My extractions";
?>


    <p class="info">+ Add an  extraction</p>
    <table class="tab">
        <tr class="tab-head">
            <th>Name</th>
            <th>Periodicity</th>
            <th>Category</th>
        </tr>
        <?php if(isset($_SESSION['extractions'])):
             $extractions = unserialize($_SESSION['extractions']);
            foreach($extractions as $extraction): ?>
            <tr>
                <td><?= $extraction->getId() ?></td>
                <td><?= $extraction->getPeriodicity() ?></td>
                <td><?= $extraction->getCategory() ?></td>
            </tr>
        <?php 
            endforeach;
            endif; 
        ?>
      
    </table>
    <?php include '../../parts/_pagination.php'; ?>


<?php
$content = ob_get_clean();
require('_template-admin.php');
?>